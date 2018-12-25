<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

namespace Foliolabs\Todo\Site;
use Foliolabs\Component\Base;
use Kodekit\Library;

class ControllerToolbarTask extends Base\ControllerToolbarActionbar
{
    protected function _commandNew(Library\ControllerToolbarCommand $command)
    {
        parent::_commandNew($command);

        $command->href  = 'view=task&layout=form';
        $command->label = 'Add new task';
    }

    protected function _afterBrowse(Library\ControllerContext $context)
    {
        if($this->getController()->canAdd()) {
            $this->addCommand('new');
        }
    }
}
