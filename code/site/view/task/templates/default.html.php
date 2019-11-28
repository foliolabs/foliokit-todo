<?
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

defined('KODEKIT') or die; ?>

<?= helper('ui.load'); ?>

<div class="todo_task">
    <h4 class="koowa_header">
        <? // Header title ?>
        <span class="koowa_header__task">
            <a class="koowa_header__title_link" href="<?= route($task, ['view' => 'task']); ?>">
                <?= escape($task->title); ?>
            </a>
         </span>

        <? // Label locked ?>
        <? if (can('edit') && $task->isLockable() && $task->isLocked()): ?>
            <span class="label label-warning"><?= helper('grid.lock_message', array('entity' => $task)); ?></span>
        <? endif; ?>

        <? // Label status ?>
        <? if (!$task->isPublished() || !$task->enabled): ?>
            <? $status = $task->enabled ? translate($task->status) : translate('Draft'); ?>
            <span class="label label-<?= $task->enabled ? $task->status : 'draft' ?>"><?= ucfirst($status); ?></span>
        <? endif; ?>
    </h4>
    <div class="task_description">
        <?= $task->description ?>
    </div>

    <? // Edit area | Import partial template from task view ?>
    <?= import('com://site/todo/task/manage.html', array('task' => $task)) ?>

</div>