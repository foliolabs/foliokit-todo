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

class ControllerTask extends Base\ControllerModel
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'formats'   => array('json')
        ));

        parent::_initialize($config);
    }

    public function getRequest()
    {
        $request = parent::getRequest();

        $query = $request->query;

        // Show only published tasks if user can't publish posts
        if (!$this->getUser()->authorise('publish_posts')) {
            $query->enabled = 1;
        }

        return $request;
    }
}