<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */
namespace Foliolabs\Todo;
use Kodekit\Library;
use Foliolabs\Component\Scheduler;

class JobExample extends Scheduler\JobAbstract
{
    public function run(Scheduler\JobContextInterface $context)
    {
        $context->state->example = time();

        return $this->complete();
    }
}
