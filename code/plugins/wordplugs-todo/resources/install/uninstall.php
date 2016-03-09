<?php
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

function todo_uninstall()
{
    $db  = $GLOBALS['wpdb'];
    $sql = str_replace('#__', $db->prefix, file_get_contents(__DIR__.'/uninstall.sql'));

    $matches = array();
    preg_match_all("/^DROP(?:[^;]|(?:'.*?'))+;\\n*$/im", $sql, $matches);

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    foreach($matches[0] as $sql) {
        $wpdb->query($sql);
    }

    delete_option('todo_installed');
}