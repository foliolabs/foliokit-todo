<?php
/**
 * Todo Plugin for Wordpress
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/wordpress-todo for the canonical source repository
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
