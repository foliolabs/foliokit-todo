<?php
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

use Wordplugs\Component\Base;

/**
 *  Todo Dispatcher Router
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Component\Koowa\Dispatcher\Request
 */
class TodoDispatcherRouter extends Base\DispatcherRouterAbstract
{
    public function parse(\KHttpUrlInterface $url)
    {
        $segments = $url->getPath(true);
        $query    = array();

        if(count($segments))
        {
            $view = array_shift($segments);

            if(in_array($view, array('task', 'tasks')))
            {
                $query['view'] = $view;
                if($view == 'task') {
                    $query['id'] = array_shift($segments);
                }
            }
        }

        return $query;
    }

    public function build(\KHttpUrlInterface $url)
    {
        $query    = $url->getQuery(true);
        $segments = array();

        if(isset($query['view']))
        {
            $segments[] = $query['view'];
            unset( $query['view'] );
        }

        if(isset($query['id']))
        {
            $segments[] = $query['id'];
            unset( $query['id'] );
        }

        $url->setQuery($query);
        $url->setPath(implode('/', $segments));

        return parent::build($url);
    }
}