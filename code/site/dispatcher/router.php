<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

namespace Foliolabs\Todo\Site;
use Foliolabs\Component\Base;
use Kodekit\Library;

class DispatcherRouter extends Base\DispatcherRouterComponentSite
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append([
            'resolvers' => [
                'regex' => [
                    'routes' => [
                        '[alpha:view]/[digit:id]', // task/1
                         '' // menu root
                    ]
                ]
            ]
        ]);

        parent::_initialize($config);
    }

    public function generate($entity, array $parameters = [])
    {
        $route    = $this->getRoute($entity, $parameters);

        if ($entity instanceof Library\ModelEntityRowset && count($entity) === 1) {
            $entity = $route->getIterator()->current();
        }

        if ($entity instanceof Library\ModelEntityInterface) {
            $route->setPath($entity->getIdentifier()->getName() . '/' . $entity->id);
        }

        unset($parameters['view']);
        unset($parameters['component']);

        if (isset($parameters['layout']) && $parameters['layout'] === 'default'){
            unset($parameters['layout']);
        }

        $route->setQuery($parameters);

        $route = parent::generate($route, $parameters);

        return $route;
    }
}
