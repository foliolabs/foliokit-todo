<?php
/**
 * Todo Plugin for Wordpress
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/wordpress-todo for the canonical source repository
 */

class ComTodoControllerItem extends ComKoowaControllerModel
{
	protected function _initialize(KObjectConfig $config)
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