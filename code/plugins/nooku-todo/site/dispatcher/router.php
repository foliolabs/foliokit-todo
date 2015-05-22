<?php
/**
 * Nooku Framework for Wordpress - http://nooku.org/framework
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/nooku-framework-wordpress for the canonical source repository
 */

/**
 *  Todo Dispatcher Router
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Component\Koowa\Dispatcher\Request
 */
class ComTodoDispatcherRouter extends ComKoowaDispatcherRouterAbstract
{
    public function parse(KHttpUrlInterface $url)
    {
        $segments = $url->getPath(true);
        $query    = array();

        if(count($segments))
        {
            $view = array_shift($segments);

            if(in_array($view, array('item', 'items')))
            {
                $query['view'] = $view;
                if($view == 'item') {
                    $query['id'] = array_shift($segments);
                }
            }
        }

        return $query;
    }

    public function build(KHttpUrlInterface $url)
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