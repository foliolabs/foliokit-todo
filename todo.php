<?php
/**
 * Nooku Framework for Wordpress - http://nooku.org/framework
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/nooku-framework-wordpress for the canonical source repository
 */

/*
Plugin Name: Todo
Plugin URI: http://github.com/nooku/wordpress-todo
Description: TODO Plugin for Wordpress
Author: Johan Janssens and Timble CVBA
Version: 0.1
Author URI: http://nooku.org/
*/
defined( 'ABSPATH' ) or die();

add_action('koowa_before_bootstrap', 'todo_bootstrap');

function todo_bootstrap()
{
    KObjectManager::getInstance()
        ->getObject('lib:object.bootstrapper')
        ->registerComponent('todo', __DIR__, 'todo')
        ->registerComponent('todo', __DIR__.'/admin', 'admin');
}