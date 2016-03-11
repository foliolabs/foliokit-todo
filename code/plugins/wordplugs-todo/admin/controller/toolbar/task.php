<?php
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

class ComTodoControllerToolbarTask extends ComKoowaControllerToolbarActionbar
{
    protected function _afterBrowse(KControllerContextInterface $context)
    {
        parent::_afterBrowse($context);

        $controller = $this->getController();

        $this->addSeparator();
        $this->addPublish(array('allowed' => $controller->canEdit()));
        $this->addUnpublish(array('allowed' => $controller->canEdit()));

        if($controller->canBrowse()) {
            $this->addSeparator()->addExport();
        }
    }

    protected function _commandExport(KControllerToolbarCommand $command)
    {
        $command->attribs->download = $this->getObject('translator')->translate('tasks');
        $command->attribs->href     = $this->getController()->getView()->getRoute('format=csv', false, false);
    }
}
