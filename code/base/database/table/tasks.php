<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

namespace Foliolabs\Todo;
use Kodekit\Library;

class DatabaseTableTasks extends Library\DatabaseTableAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array(
                'lockable',
                'creatable',
                'modifiable',
                'sluggable',
                'identifiable',
                'parameterizable',
            ),
            'filters' => array(
                'title'        => array('trim'),
                'description'  => array('trim', 'html')
            )
        ));

        parent::_initialize($config);
    }
}
