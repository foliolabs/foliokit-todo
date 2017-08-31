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

class ControllerToolbarWordpress extends Library\Object
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $router = function($query) {
            $request = $this->getObject('request');

            if($request->getQuery()->has('component')) {
                echo $this->getObject('response')->getContent();
            } else {
                wp_redirect((string)$request->getUrl()->setQuery($query));
            }
        };

        // Add the commands
        foreach ($config->commands as $menu)
        {
            $query = array();
            parse_str((string) $menu->route, $query);
            $query['page'] = $menu->page;

            add_menu_page(
                $menu->title,
                $menu->title,
                $menu->permission,
                $menu->page,
                function () use ($query, $router) { $router($query); }
            );

            if ($menu->commands)
            {
                foreach ($menu->commands as $submenu)
                {
                    $query = array();
                    parse_str((string) $submenu->route ?: $menu->route, $query);
                    $query['page'] = $submenu->page ?: $menu->page;

                    add_submenu_page(
                        $menu->page,
                        $submenu->title,
                        $submenu->title,
                        $submenu->permission ?: $menu->permission,
                        $submenu->page,
                        $submenu->route ? function () use ($query) { foliokit_route($query); } : null
                    );
                }

            }
        }
    }
    /**
     * Initializes the config for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param   Library\ObjectConfig $config Configuration options
     * @return  void
     */
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'commands' => [
                [
                    'title' => 'Todo',
                    'page'  => 'todo-tasks',
                    'route' => 'component=todo&view=tasks',
                    'permission' => 'manage_options',
                    'commands' => [
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
        ));

        parent::_initialize($config);
    }
}
