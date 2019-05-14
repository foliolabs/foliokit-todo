<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */


return [
    'identifiers' => [
        'com:base.dispatcher.page' => [
            'blocks' => [
                'com:todo.block.todo'
            ],
            'endpoints' => [
                'todo-page' => [
                    'route' => 'component=todo&view=tasks',
                    'title' => 'Todo page',
                ]
            ]
        ],
        'com:scheduler.controller.dispatcher' => array(
            'jobs' => array(
                'com:todo.job.example',
            )
        ),
    ]
];