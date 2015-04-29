<?php
/**
 * Todo Plugin for Wordpress
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/wordpress-todo for the canonical source repository
 */

/**
 * Item Controller Permission
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Library\Controller\Permission
 */
class ComTodoControllerPermissionItem extends KControllerPermissionAbstract
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

    /**
     * Permission handler for add actions
     *
     * Method returns TRUE iff the controller implements the KControllerModellable interface and the user is authentic
     * and the account is enabled.
     *
     * @return  boolean  Return TRUE if action is permitted. FALSE otherwise.
     */
    public function canAdd()
    {
        return $this->getUser()->authorise('edit_posts');
    }

    /**
     * Permission handler for edit actions
     *
     * Method returns TRUE iff the controller implements the KControllerModellable interface and the user is authentic
     * and the account is enabled.
     *
     * @return  boolean  Return TRUE if action is permitted. FALSE otherwise.
     */
    public function canEdit()
    {
        return $this->getUser()->authorise('edit_posts');
    }

    /**
     * Permission handler for delete actions
     *
     * Method returns true of the controller implements KControllerModellable interface and the user is authentic.
     *
     * @return  boolean  Returns TRUE if action is permitted. FALSE otherwise.
     */
    public function canDelete()
    {
        return $this->getUser()->authorise('delete_posts');
    }
}