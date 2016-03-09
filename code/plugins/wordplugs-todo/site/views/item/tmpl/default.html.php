<?
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<div class="todo_item">
    <h4 class="koowa_header">
        <? // Header title ?>
        <span class="koowa_header__item">
            <a class="koowa_header__title_link" href="<?= route('view=item&id='.$item->id); ?>">
                <?= escape($item->title); ?>
            </a>
         </span>

        <? // Label locked ?>
        <? if ($item->isPermissible() && $item->canPerform('edit') && $item->isLockable() && $item->isLocked()): ?>
            <span class="label label-warning"><?= helper('grid.lock_message', array('entity' => $item)); ?></span>
        <? endif; ?>

        <? // Label status ?>
        <? if (!$item->isPublished() || !$item->enabled): ?>
            <? $status = $item->enabled ? translate($item->status) : translate('Draft'); ?>
            <span class="label label-<?= $item->enabled ? $item->status : 'draft' ?>"><?= ucfirst($status); ?></span>
        <? endif; ?>
    </h4>
    <div class="item_description">
        <?= $item->description ?>
    </div>

    <? // Edit area | Import partial template from item view ?>
    <?= import('com://site/todo.item.manage.html', array('item' => $item)) ?>

</div>