<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

/*
Plugin Name: Foliolabs-Todo
Plugin URI: http://github.com/foliolabs/foliolabs-todo
Description: Todo Plugin for Wordpress
Author: Foliolabs
Version: 0.1
Author URI: http://foliolabs.com/
*/
defined( 'ABSPATH' ) or die();


register_activation_hook(__FILE__, function() {
    require_once __DIR__.'/base/resources/install/install.php';
    todo_install();
});

add_action('foliokit_before_bootstrap', function()
{
    foliokit_register_plugin(__FILE__);

    /*
    // Check for updates
    if(is_admin())
    {
        $manager->getObject('com://admin/todo.resources.updater', array(
            'plugin_file'  => __FILE__,
            'releases_url' => 'https://api.github.com/repos/foliolabs/foliolabs-todo/releases'
        ));
    }
    */
});