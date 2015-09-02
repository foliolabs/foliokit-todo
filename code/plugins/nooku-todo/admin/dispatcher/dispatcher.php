<?php
/**
 * Todo Plugin for Wordpress
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/wordpress-todo for the canonical source repository
 */

class ComTodoDispatcher extends ComKoowaDispatcher
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'controller' => 'item',
        ));

        parent::_initialize($config);
    }
}
