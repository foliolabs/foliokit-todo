<?php

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