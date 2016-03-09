<?php
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

function todo_install()
{
    if (is_plugin_active('koowa/koowa.php'))
    {
        $installed = get_option('todo_installed');

        if(!$installed)
        {
            $db  = $GLOBALS['wpdb'];
            $sql = str_replace('#__', $db->prefix, file_get_contents(__DIR__.'/install.sql'));
            $matches = array();

            preg_match_all("/^(INSERT INTO|CREATE)(?:[^;]|(?:'.*?'))+;\\n*$/im", $sql, $matches);

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

            foreach($matches[0] as $sql) {
                dbDelta(array($sql));
            }

            add_option('todo_installed', true);
        }
    }
    // TODO: Gracefully inform that Wordplugs Framework is required.
    else wp_die("Wordplugs Framework is required!");
}