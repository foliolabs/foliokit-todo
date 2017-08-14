<?php
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

/*
Plugin Name: Wordplugs-Todo
Plugin URI: http://github.com/wordplugs/wordplugs-todo
Description: Todo Plugin for Wordpress
Author: Wordplugs
Version: 0.1
Author URI: http://wordplugs.com/
*/
defined( 'ABSPATH' ) or die();


register_activation_hook(__FILE__, function()
{
    /*KObjectManager::getInstance()->getObject('com://admin/todo.installer', array(
        'basepath' => __DIR__
    ))->install();*/
});

add_action('wordplugs_before_bootstrap', function()
{
    //Register the components
    Kodekit::getObject('object.bootstrapper')
        ->registerComponent(__DIR__.'/admin', is_admin(), array(__DIR__.'/base'))
        ->registerComponent(__DIR__.'/site', !is_admin(), array(__DIR__.'/base'));

    /*
    // Check for updates
    if(is_admin())
    {
        $manager->getObject('com://admin/todo.resources.updater', array(
            'plugin_file'  => __FILE__,
            'releases_url' => 'https://api.github.com/repos/wordplugs/wordplugs-todo/releases'
        ));
    }
    */
});