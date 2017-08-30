<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

namespace Foliolabs\Todo\Admin;
use Kodekit\Library;

class ControllerActivity extends ActivitiesControllerActivity
{
    /**
     * Initializes the default configuration for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param  \KObjectConfig $config Configuration options
     * @return void
     */
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'toolbars'   => array('menubar', 'activity'),
        ));

        parent::_initialize($config);
    }
}