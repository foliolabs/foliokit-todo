<?php
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

return array(
    'identifiers' => array(
        //'com://site/todo.controller.item' => array('behaviors' => array('com:activities.controller.behavior.loggable'))
        'com://site/todo.controller.item' => array(
            'formats' => array('schema')
        )
    ),
    'aliases'    => array(
        //'com://site/todo.database.table.items'          => 'com://admin/todo.database.table.items',
        'com://site/todo.model.items'                   => 'com://admin/todo.model.items'
    )
);
