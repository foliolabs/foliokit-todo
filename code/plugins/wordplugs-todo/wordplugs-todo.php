<?php
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

/*
Plugin Name: Todo
Plugin URI: http://github.com/wordplugs/wordplugs-todo
Description: Todo Plugin for Wordpress
Author: Johan Janssens and Timble CVBA
Version: 0.1
Author URI: http://wordplugs.com/
*/
defined( 'ABSPATH' ) or die();

register_activation_hook(__FILE__, function()
{
    KObjectManager::getInstance()->getObject('com:todo.installer', array(
        'basepath' => __DIR__
    ))->install();
});

add_action('koowa_before_bootstrap', function()
{
    $manager = KObjectManager::getInstance();
    $manager->getObject('lib:object.bootstrapper')
        ->registerComponent('todo', __DIR__, 'todo')
        ->registerComponent('todo', __DIR__.'/admin', 'admin');
        //->registerComponent('todo', __DIR__.'/site', 'site');

    /*
    // Use the updater and check releases from GitHub
    if(is_admin()) {
        $manager->getObject('com:todo.resources.updater', array(
            'plugin_file'  => __FILE__,
            'releases_url' => 'https://api.github.com/repos/wordplugs/wordplugs-todo/releases'
        ));
    }
    */
});