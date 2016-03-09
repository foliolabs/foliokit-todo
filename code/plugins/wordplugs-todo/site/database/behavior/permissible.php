<?php
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

class ComTodoDatabaseBehaviorPermissible extends KDatabaseBehaviorAbstract
{
    public function canPerform($action)
    {
        return $this->getObject('user')->authorise($action);
    }
}