<?php
/**
 * FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliokit for the canonical source repository
 */

namespace Foliolabs\Todo;

use Foliolabs\Component\Base;
use Kodekit\Library;

/**
 * Block
 *
 * @author  Ercan Ozkaya <http://github.com/ercanozkaya>
 * @package Foliolabs\Component\Base
 */
class BlockTodo extends Base\BlockPage
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append([
            'name'  => 'foliolabs-todo',
            'title' => 'Foliolabs Todo',
            'description' => 'Displays a list of todo items. Only use on pages, NOT posts.'
        ]);

        parent::_initialize($config);
    }
}
