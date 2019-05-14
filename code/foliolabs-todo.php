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

require __DIR__.'/base/resources/install/install.php';

\Foliolabs\Todo\InstallerHelper::initialize(__FILE__);

add_action('foliokit_before_bootstrap', function() {
    foliokit_register_plugin(__FILE__);
});
