<?
/**
 * Todo Plugin for Wordpress
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/wordpress-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<? // Description field ?>
<div class="todo_grid description_container">
    <div class="control-group todo_grid__item one-whole">
        <div class="controls">
            <?= helper('editor.display', array(
                'name' => 'description',
                'value' => $item->description,
                'id'   => 'description',
                'width' => '100%',
                'height' => '341',
                'cols' => '100',
                'rows' => '20',
                'buttons' => array('pagebreak')
            )); ?>
        </div>
    </div>
</div>