<?php
/**
 * Todo Plugin for Wordpress
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/wp-todo for the canonical source repository
 */

class ComTodoDatabaseBehaviorPermissible extends KDatabaseBehaviorAbstract
{
    public function canPerform($action)
    {
        return $this->getObject('user')->authorise($action);
    }
}