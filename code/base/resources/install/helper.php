<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */


namespace Foliolabs\Todo;

require_once ABSPATH . 'wp-admin/includes/plugin.php';

class InstallHelper
{
    public $component;

    public $option_namespace;

    public $current_version;
    public $installed_version;

    public $plugin;
    public $plugin_file;
    public $plugin_dir;
    public $plugin_basename;

    public $wpdb;

    public static function initialize($pluginfile)
    {
        $install = function() use ($pluginfile) {
            $helper = new InstallHelper($pluginfile);

            if ($helper->needsInstall()) {
                $helper->run();
            }
        };

        add_action( 'upgrader_process_complete', function($upgrader, $options) use($install, $pluginfile) {
            if( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {
                foreach( $options['plugins'] as $plugin ) {
                    if( $plugin === plugin_basename($pluginfile)) {
                        $install();
                    }
                }
            }
        }, 10, 2 );

        if (is_admin()) {
            add_action('plugins_loaded', $install);
        }

        register_activation_hook($pluginfile, $install);
    }

    public function __construct($pluginfile)
    {
        global $wpdb;

        $this->plugin_file     = $pluginfile; // e.g. ABSPATH/plugins/foliolabs-todo/foliolabs-todo.php
        $this->plugin          = basename($this->plugin_file, '.php'); // e.g. foliolabs-todo
        $this->plugin_dir      = plugin_dir_path($pluginfile); // e.g. ABSPATH/plugins/foliolabs-todo
        $this->plugin_basename = plugin_basename($this->plugin_file); // e.g. foliolabs-todo/foliolabs-todo.php

        $this->wpdb = $wpdb;

        if (($pos = strrpos($this->plugin, '-')) !== false) {
            $this->component = substr($this->plugin, $pos+1);
        } else {
            $this->component = $this->plugin;
        }

        $this->option_namespace = str_replace(['-', '.', ' '], '_', $this->plugin);

        $metadata = get_plugin_data($pluginfile);

        $this->current_version   = isset($metadata['Version']) ? $metadata['Version'] : null;
        $this->installed_version = get_option($this->option_namespace.'_version');
    }

    public function needsInstall()
    {
        if (!$this->installed_version
            || ($this->current_version !== $this->installed_version)
            || (is_admin() && $this->component && @$_GET['component'] === $this->component && @$_GET['reinstall'])
        ) {
            return true;
        }
    }

    public function abort($error)
    {
        if (is_array($error)) {
            $error = implode('<br />', $error);
        }

        add_action( 'admin_notices', function () use ($error) {
            $class = 'notice notice-error';

            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $error ) );

            //Adding @ before will prevent XDebug output
            @trigger_error($error, E_USER_ERROR);
        });

        $this->deactivate();
    }

    public function deactivate()
    {
        deactivate_plugins($this->plugin_basename);
    }

    public function run()
    {
        @set_time_limit(@ini_get('max_execution_time'));
        @ini_set('memory_limit', '256M');
        @ini_set('memory_limit', '512M');

        $errors = array();

        $privileges = $this->getRequiredDatabasePrivileges();
        if ($privileges && ($failed = $this->_checkDatabasePrivileges($privileges))) {
            $errors[] = sprintf('The following MySQL privileges are missing: %s. Please make them available to your MySQL user and try again.',
                htmlspecialchars(implode(', ', $failed), ENT_QUOTES));
        }

        if ($system_errors = $this->getSystemErrors()) {
            $errors = array_merge($errors, $system_errors);
        }

        if ($errors) {
            $this->abort($errors);

            return false;
        }

        $this->_installFramework();

        if ($this->installed_version && ($this->current_version !== $this->installed_version)) {
            $this->update();
        } else {
            $this->install();
        }

        $this->_clearCache();

        update_option($this->option_namespace.'_version', $this->current_version);

        return true;
    }

    public function install()
    {
        $install_sql = $this->plugin_dir.'/base/resources/install/install.sql';

        if (file_exists($install_sql)) {
            $this->_executeSqlFile($install_sql);
        }

        $this->_migrate();
    }

    public function update()
    {
        $this->install();
    }

    public function uninstall()
    {
        $this->_clearCache();
    }

    public function getSystemErrors()
    {
        $errors = [];

        if(version_compare(phpversion(), '5.4', '<'))
        {
            $errors[] = sprintf('Your server is running PHP %s which is an old and insecure version.
            It also contains a bug affecting the operation of our extensions.
            Please contact your host and ask them to upgrade PHP to at least 5.4 version on your server.', phpversion());
        }

        if (!function_exists('token_get_all')) {
            $errors[] = 'PHP tokenizer extension must be enabled by your host.';
        }

        if(!class_exists('mysqli')) {
            $errors[] = "We're sorry but your server isn't configured with the MySQLi database driver. Please
		    contact your host and ask them to enable MySQLi for your server.";
        }

        if(version_compare($this->wpdb->db_version(), '5.1', '<')) {
            $errors[] = sprintf('Joomlatools framework requires MySQL 5.1 or later.
            Please contact your host and ask them to upgrade MySQL to 5.1 or a newer version on your server.');
        }
        else {
            $result = $this->wpdb->get_var("SELECT SUPPORT FROM INFORMATION_SCHEMA.ENGINES WHERE ENGINE = 'InnoDB'");
            if(!in_array(strtoupper($result), array('YES', 'DEFAULT'))) {
                $errors[] = "Foliokit requires MySQL InnoDB support. Please contact your host and ask them to enable InnoDB.";
            }
        }

        return $errors;
    }

    public function getRequiredDatabasePrivileges()
    {
        return array();
    }

    protected function _installFramework()
    {
        $bundled_installer   = $this->plugin_dir.'/framework/component/base/resources/install/install.php';
        $existing_installer  = WP_PLUGIN_DIR.'/foliokit/component/base/resources/install/install.php';

        foreach ([$bundled_installer, $existing_installer] as $installer_file) {
            if (is_file($installer_file)) {
                $installer = require $installer_file;

                if (is_callable($installer)) {
                    $installer();
                }
            }
        }
    }

    protected function _runFrameworkQueries($plugin_dir)
    {
        $results = glob($plugin_dir.'/component/*/resources/install/install.sql');
        $queries = array();

        foreach ($results as $result) {
            if ($q = $this->_splitSql(file_get_contents($result))) {
                $queries = array_merge($queries, $q);
            }
        }

        foreach ($queries as $query) {
            $query = trim($query);

            if ($query != '' && $query{0} != '#') {
                try {
                    $this->_executeQuery($query);
                } catch (\Exception $e) {
                }
            }
        }
    }

    protected function _deleteFolder($src) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                $full = $src . '/' . $file;
                if ( is_dir($full) ) {
                    $this->_deleteFolder($full);
                }
                else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($src);

        return true;
    }

    protected function _moveFolder($src, $dest)
    {
        if (!is_dir($src) || is_dir($dest)) {
            return false;
        }

        return @rename($src, $dest);
    }

    protected function _copyFolder($src, $dest)
    {
        // Eliminate trailing directory separators, if any
        $src = rtrim($src, DIRECTORY_SEPARATOR);
        $dest = rtrim($dest, DIRECTORY_SEPARATOR);

        if (!is_dir($src)) {
            return false;
        }

        if (is_dir($dest)) {
            return false;
        }

        if (!mkdir($dest)) {
            return false;
        }

        if (!($dh = @opendir($src))) {
            return false;
        }

        // Walk through the directory copying files and recursing into folders.
        while (($file = readdir($dh)) !== false)
        {
            $sfid = $src . '/' . $file;
            $dfid = $dest . '/' . $file;

            switch (filetype($sfid))
            {
                case 'dir':
                    if ($file != '.' && $file != '..')
                    {
                        $ret = $this->_copyFolder($sfid, $dfid);

                        if ($ret !== true) {
                            return $ret;
                        }
                    }
                    break;

                case 'file':
                    if (!@copy($sfid, $dfid)) {
                        return false;
                    }
                    break;
            }
        }

        return true;
    }

    protected function _moveFolderWithBackup($from, $to)
    {
        $from = rtrim($from, '/');
        $to = rtrim($to, '/');

        $temp   = $to.'_tmp';
        $bkp    = $to.'_bkp';

        if (is_dir($temp)) {
            if (!$this->_deleteFolder($temp) || is_dir($temp)) {
                return false;
            }
        }

        if ($this->_copyFolder($from, $temp))
        {
            if (is_dir($to)) {
                if (!$this->_copyFolder($to, $bkp)) {
                    return false;
                }

                if (!$this->_deleteFolder($to) || is_dir($to)) {
                    return false;
                }
            }

            $result = @rename($temp, $to);

            if ($result) {
                if (is_dir($from)) {
                    $this->_deleteFolder($from);
                }

                if (is_dir($bkp)) {
                    $this->_deleteFolder($bkp);
                }

            }
        }

        return true;
    }

    protected function _deleteOldFiles($nodes = [])
    {
        foreach ($nodes as $node)
        {
            $path = ABSPATH.'/'.$node;

            if (file_exists($path)) {
                if (is_dir($path)) {
                    $this->_deleteFolder($path);
                } else {
                    unlink($path);
                }
            }
        }

        return true;
    }

    protected function _executeQuery($query) {
        return $this->wpdb->query($this->_replacePrefix($query));
    }

    protected function _executeQueries($queries)
    {
        if (is_string($queries)) {
            $queries = $this->_splitSql($queries);
        }

        foreach ($queries as $query) {
            $this->_executeQuery($query);
        }
    }

    protected function _executeSqlFile($file)
    {
        $buffer = file_get_contents($file);

        if ($buffer !== false) {
            $this->_executeQueries($buffer);
        }
    }

    protected function _replacePrefix($sql, $prefix = '#__')
    {
        $escaped   = false;
        $startPos  = 0;
        $quoteChar = '';
        $literal   = '';
        $sql = trim($sql);
        $n   = \strlen($sql);
        while ($startPos < $n)
        {
            $ip = strpos($sql, $prefix, $startPos);
            if ($ip === false)
            {
                break;
            }
            $j = strpos($sql, "'", $startPos);
            $k = strpos($sql, '"', $startPos);
            if (($k !== false) && (($k < $j) || ($j === false)))
            {
                $quoteChar = '"';
                $j         = $k;
            }
            else
            {
                $quoteChar = "'";
            }
            if ($j === false)
            {
                $j = $n;
            }
            $literal .= str_replace($prefix, $this->wpdb->prefix, substr($sql, $startPos, $j - $startPos));
            $startPos = $j;
            $j = $startPos + 1;
            if ($j >= $n)
            {
                break;
            }
            // Quote comes first, find end of quote
            while (true)
            {
                $k       = strpos($sql, $quoteChar, $j);
                $escaped = false;
                if ($k === false)
                {
                    break;
                }
                $l = $k - 1;
                while ($l >= 0 && $sql{$l} === '\\')
                {
                    $l--;
                    $escaped = !$escaped;
                }
                if ($escaped)
                {
                    $j = $k + 1;
                    continue;
                }
                break;
            }
            if ($k === false)
            {
                // Error in the query - no end quote; ignore it
                break;
            }
            $literal .= substr($sql, $startPos, $k - $startPos + 1);
            $startPos = $k + 1;
        }
        if ($startPos < $n)
        {
            $literal .= substr($sql, $startPos, $n - $startPos);
        }
        return $literal;
    }

    protected function _tableExists($table)
    {
        if (substr($table, 0,  3) !== '#__') {
            $table = '#__'.$table;
        }

        $table = str_replace('#__', $this->wpdb->prefix, $table);

        return (bool) $this->wpdb->get_var($this->wpdb->prepare('SHOW TABLES LIKE %s', $table));
    }

    protected function _columnExists($table, $column)
    {
        $result = false;

        if (substr($table, 0,  3) !== '#__') {
            $table = '#__'.$table;
        }

        $table = str_replace('#__', $this->wpdb->prefix, $table);

        if ($this->_tableExists($table))
        {
            $query  = 'SHOW COLUMNS FROM '.$table.' WHERE Field = %s';
            $result = (bool) $this->wpdb->get_var($this->wpdb->prepare($query, $column));
        }

        return $result;
    }

    protected function _indexExists($table, $index_name)
    {
        $result = false;

        if (substr($table, 0,  3) !== '#__') {
            $table = '#__'.$table;
        }

        $table = str_replace('#__', $this->wpdb->prefix, $table);

        if ($this->_tableExists($table))
        {
            $query  = 'SHOW KEYS FROM '.$table.' WHERE Key_name = %s';
            $result = (bool) $this->wpdb->get_var($this->wpdb->prepare($query, $index_name));
        }

        return $result;
    }

    protected function _backupTable($table)
    {
        if ($this->_tableExists($table))
        {
            $destination = $table.'_bkp';

            if ($this->_tableExists($destination))
            {
                $i = 2;

                while (true)
                {
                    if (!$this->_tableExists($destination.$i)) {
                        break;
                    }

                    $i++;
                }

                $destination .= $i;
            }

            if (substr($table, 0,  3) !== '#__') {
                $table = '#__'.$table;
            }

            if (substr($destination, 0,  3) !== '#__') {
                $destination = '#__'.$destination;
            }

            $table       = str_replace('#__', $this->wpdb->prefix, $table);
            $destination = str_replace('#__', $this->wpdb->prefix, $destination);

            $return = $this->wpdb->query(sprintf('RENAME TABLE `%1$s` TO `%2$s`;', $table, $destination));
        }
        else $return = true;

        return $return;
    }

    protected function _clearCache()
    {
        // Clear APC opcode cache
        if (extension_loaded('apc'))
        {
            apc_clear_cache();
            apc_clear_cache('user');
        }

        // Clear OPcache
        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }
    }


    /**
     * Tests a list of DB privileges against the current application DB connection.
     *
     * @param array $privileges An array containing the privileges to be checked.
     *
     * @return array True An array containing the privileges that didn't pass the test, i.e. not granted.
     */
    protected function _checkDatabasePrivileges($privileges)
    {
        $privileges = (array) $privileges;

        $sql_mode = $this->wpdb->get_var('SELECT @@SQL_MODE');

        // Quote and escape DB name.
        if (strtolower($sql_mode) == 'ansi_quotes') {
            // Double quotes as delimiters.
            $db_name = '"' . str_replace('"', '""', DB_NAME) . '"';
        } else {
            $db_name = '`' . str_replace('`', '``', DB_NAME) . '`';
        }

        // Properly escape DB name.
        $possible_tables = array(
            '*.*',
            $db_name . '.*',
            strtolower($db_name . '*'),
            str_replace('_', '\_', $db_name) . '.*',
            strtolower(str_replace('_', '\_', $db_name) . '.*')
        );

        $grants = $this->wpdb->get_col('SHOW GRANTS');
        $granted = array();

        foreach ($grants as $grant)
        {
            if (stripos($grant, 'USAGE ON') === false)
            {
                foreach ($privileges as $privilege)
                {
                    $regex = '/(grant\s+|,\s*)' . $privilege . '(\s*,|\s+on)/i';

                    if (stripos($grant, 'ALL PRIVILEGES') || preg_match($regex, $grant))
                    {
                        // Check tables
                        $tables = substr($grant, stripos($grant, ' ON ') + 4);
                        $tables = substr($tables, 0, stripos($tables, ' TO'));
                        $tables = trim($tables);

                        if (in_array($tables, $possible_tables)) {
                            $granted[] = $privilege;
                        }
                    }
                }
            }
            else
            {
                // Proceed with installation if user is granted USAGE
                $granted = $privileges;
                break;
            }
        }

        return array_diff($privileges, $granted);
    }

    protected function _migrate()
    {
    }

    protected function _splitSql($sql)
    {
        $start = 0;
        $open = false;
        $comment = false;
        $endString = '';
        $end = strlen($sql);
        $queries = array();
        $query = '';

        for ($i = 0; $i < $end; $i++)
        {
            $current = substr($sql, $i, 1);
            $current2 = substr($sql, $i, 2);
            $current3 = substr($sql, $i, 3);
            $lenEndString = strlen($endString);
            $testEnd = substr($sql, $i, $lenEndString);

            if ($current == '"' || $current == "'" || $current2 == '--'
                || ($current2 == '/*' && $current3 != '/*!' && $current3 != '/*+')
                || ($current == '#' && $current3 != '#__')
                || ($comment && $testEnd == $endString))
            {
                // Check if quoted with previous backslash
                $n = 2;

                while (substr($sql, $i - $n + 1, 1) == '\\' && $n < $i)
                {
                    $n++;
                }

                // Not quoted
                if ($n % 2 == 0)
                {
                    if ($open)
                    {
                        if ($testEnd == $endString)
                        {
                            if ($comment)
                            {
                                $comment = false;
                                if ($lenEndString > 1)
                                {
                                    $i += ($lenEndString - 1);
                                    $current = substr($sql, $i, 1);
                                }
                                $start = $i + 1;
                            }
                            $open = false;
                            $endString = '';
                        }
                    }
                    else
                    {
                        $open = true;
                        if ($current2 == '--')
                        {
                            $endString = "\n";
                            $comment = true;
                        }
                        elseif ($current2 == '/*')
                        {
                            $endString = '*/';
                            $comment = true;
                        }
                        elseif ($current == '#')
                        {
                            $endString = "\n";
                            $comment = true;
                        }
                        else
                        {
                            $endString = $current;
                        }
                        if ($comment && $start < $i)
                        {
                            $query = $query . substr($sql, $start, ($i - $start));
                        }
                    }
                }
            }

            if ($comment)
            {
                $start = $i + 1;
            }

            if (($current == ';' && !$open) || $i == $end - 1)
            {
                if ($start <= $i)
                {
                    $query = $query . substr($sql, $start, ($i - $start + 1));
                }
                $query = trim($query);

                if ($query)
                {
                    if (($i == $end - 1) && ($current != ';'))
                    {
                        $query = $query . ';';
                    }
                    $queries[] = $query;
                }

                $query = '';
                $start = $i + 1;
            }
        }

        return $queries;
    }
}