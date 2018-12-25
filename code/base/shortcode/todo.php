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
 * Include shortcode
 *
 * @author  Ercan Ozkaya <http://github.com/ercanozkaya>
 * @package Foliolabs\Component\Base
 */
class ShortcodeTodo extends Base\ShortcodePage
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append([
            'code'       => 'foliolabs-todo',
            'attributes' => [
                'component' => 'todo'
            ]
        ]);

        parent::_initialize($config);
    }
}
