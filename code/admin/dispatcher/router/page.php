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

class DispatcherRouterPage extends Base\DispatcherRouterPage
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append([
            'pages' => [
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
            ]
        ]);

        parent::_initialize($config);
    }
}
