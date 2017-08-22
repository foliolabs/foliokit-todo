<?
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<? // Description field ?>
<div class="todo_grid description_container">
    <div class="control-group todo_grid__task one-whole">
        <div class="controls">
            <?= helper('editor.display', array(
                'name'  => 'description',
                'value' => $task->description
            )); ?>
        </div>
    </div>
</div>