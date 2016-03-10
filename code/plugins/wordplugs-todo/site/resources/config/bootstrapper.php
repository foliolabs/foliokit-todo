<?php
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

return array(

    'aliases'    => array(
        'com://site/todo.database.table.tasks' => 'com://admin/todo.database.table.tasks',
        'com://site/todo.model.tasks'          => 'com://admin/todo.model.tasks'
    ),

    'identifiers' => array(

        'com://site/todo.controller.task' => array(
            'behaviors' => array('com:activities.controller.behavior.loggable')
        ),

        'com://site/todo.controller.task' => array(
            'formats' => array('schema')
        )
    ),
);
