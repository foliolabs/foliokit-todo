<?php
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

class ComTodoControllerToolbarItem extends ComKoowaControllerToolbarActionbar
{
    protected function _commandNew(KControllerToolbarCommand $command)
    {
        $command->href  = 'view=item&layout=form';
        $command->label = 'Add new item';
    }

    protected function _afterBrowse(KControllerContextInterface $context)
    {
        if($this->getController()->canAdd()) {
            $this->addCommand('new');
        }
    }

    protected function _afterRead(KControllerContextInterface $context)
    {
        $allowed = true;

        if (isset($context->result) && $context->result->isLockable() && $context->result->isLocked()) {
            $allowed = false;
        }

        $this->addCommand('apply', array('allowed' => $allowed));
        $this->addCommand('save', array('allowed' => $allowed));
        $this->addCommand('cancel');

        $controller = $this->getController();
        $name    = strtolower($controller->getIdentifier()->name);
        $unique  = $controller->getModel()->getState()->isUnique();
        $title   = $this->getObject('translator')->translate($unique ? 'Edit {item_type}' : 'Create new {item_type}',
            array('item_type' => $name));

        $this->getCommand('title')->title = $title;
    }
}
