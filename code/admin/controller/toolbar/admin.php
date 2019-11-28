<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

namespace Foliolabs\Todo\Admin;
use Foliolabs\Component\Base;
use Kodekit\Library;

class ControllerToolbarAdmin extends Base\ControllerToolbarAdmin
{
    public function getCommands()
    {
        return [
            [
                'title' => 'Todo',
                'page'  => 'todo-tasks',
                'route' => 'component=todo&view=tasks',
                'permission' => 'manage_options',
                'pages' => [
                    [
                        'title' => 'Tasks',
                        'page'  => 'todo-tasks',
                    ],
                    [
                        'title' => 'Activities',
                        'page'  => 'todo-activities',
                        'route' => 'component=todo&view=activities',
                    ]
                ]
            ]
        ];
    }
}
