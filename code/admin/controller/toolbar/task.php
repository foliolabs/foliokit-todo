<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

namespace Todo\Admin;
use Foliolabs\Component\Base;
use Kodekit\Library;

class ControllerToolbarTask extends Base\ControllerToolbarActionbar
{
    protected function _afterBrowse(Library\ControllerContext $context)
    {
        parent::_afterBrowse($context);

        $controller = $this->getController();

        $this->addSeparator();
        $this->addPublish(array('allowed' => $controller->canEdit()));
        $this->addUnpublish(array('allowed' => $controller->canEdit()));

        if($controller->canBrowse()) {
            $this->addSeparator();
            $this->addExport();
        }
    }

    protected function _commandExport(Library\ControllerToolbarCommand $command)
    {
        $command->attribs->download = $this->getObject('translator')->translate('tasks');
        $command->attribs->href     = $this->getController()->getView()->getRoute('format=csv', false, false);
    }
}
