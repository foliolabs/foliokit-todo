<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

delete_option('todo_installed');

if(is_plugin_active('foliokit/foliokit.php') && did_action('foliokit_after_bootstrap'))
{
    try {
        \Kodekit::getObject('database.driver.mysqli')
            ->execute(file_get_contents(__DIR__.'/uninstall.sql'), \Kodekit\Library\Database::MULTI_QUERY);
    } catch (\Exception $e) {
        if (JDEBUG) throw $e;
    }
}