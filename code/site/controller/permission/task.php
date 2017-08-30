<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

use Foliolabs\Component\Base;

/**
 * Task Controller Permission
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Library\Controller\Permission
 */
class TodoControllerPermissionTask extends Base\ControllerPermissionAbstract
{
    /**
     * Permission handler for read actions
     *
     * Method returns TRUE iff the controller implements the KControllerModellable interface.
     *
     * @return  boolean Return TRUE if action is permitted. FALSE otherwise.
     */
    public function canRead()
    {
        if($this->getRequest()->query->get('layout', 'cmd') == 'form') {
            return $this->getUser()->authorise('edit_posts');
        }

        return parent::canRead();
    }
}