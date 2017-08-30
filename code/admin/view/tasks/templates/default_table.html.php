<?
/**
 * @package     DOCman
 * @copyright   Copyright (C) 2011 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */
defined('KODEKIT') or die; ?>


<div class="k-table-container">
    <div class="k-table">

        <table class="k-js-responsive-table">
            <thead>
            <tr>
                <th width="1%" class="k-table-data--form">
                    <?= helper('grid.checkall')?>
                </th>
                <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
                <th>
                    <?= helper('grid.sort', array('column' => 'title', 'title' => 'Title', 'direction' => 'asc')) ?>
                </th>
                <th width="5%" data-hide="phone,tablet">
                    <?= translate('Status') ?>
                </th>
                <th width="5%" data-hide="phone,tablet,desktop">
                    <?= translate('Owner')?>
                </th>
                <th width="5%" data-hide="phone,tablet,desktop">
                    <?= helper('grid.sort', array('column' => 'created_on', 'title' => 'Date')); ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <? foreach($tasks as $task): ?>
                <tr>
                    <td class="k-table-data--form">
                        <?= helper('grid.checkbox', array('entity'=> $task)); ?>
                    </td>
                    <td class="k-table-data--toggle"></td>
                    <td width="90%" class="k-table-data--ellipsis">
                        <a class="k-table__item-level__icon-item" data-k-tooltip='{"container":".k-ui-container","delay":{"show":500,"hide":50}}' data-original-title="<?= translate('Edit {title}', array('title' => escape($task->title))); ?>" href="<?= route('view=task&id='.$task->id)?>">
                            <?= escape($task->title) ?>
                        </a>
                    </td>
                    <td>
                        <?= helper('grid.publish', array('entity' => $task)) ?>
                    </td>
                    <td>
                        <div class="k-ellipsis" style="max-width: 150px;">
                            <?= escape($task->getAuthor()->getName()); ?>
                        </div>
                    </td>
                    <td class="k-table-data--nowrap">
                        <?= helper('date.format', array('date' => $task->created_on, 'format' => 'd M Y')); ?>
                    </td>
                </tr>
            <? endforeach ?>
            </tbody>
        </table>
    </div><!-- .k-table -->

    <? if (count($tasks)): ?>
        <div class="k-table-pagination">
            <?= helper('paginator.pagination') ?>
        </div><!-- .k-table-pagination -->
    <? endif; ?>

</div><!-- .k-table-container -->
