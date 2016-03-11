<?
/**
 * Todo Plugin for Wordpress
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/wordpress-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<div class="k-table-container">
    <div class="k-table">
        <table class="table--fixed footable">
            <thead>
            <tr>
                <th width="1%">
                    <?= helper('grid.checkall')?>
                </th>
                <th data-toggle="true">
                    <?= helper('grid.sort', array('column' => 'title', 'title' => 'Title')); ?>
                </th>
                <th width="5%" data-hide="phone,tablet">
                    <?= helper('grid.sort', array('column' => 'enabled', 'title' => 'Status')); ?>
                </th>
                <th width="5%" data-hide="phone,tablet">
                    <?= helper('grid.sort', array('column' => 'created_by', 'title' => 'Owner')); ?>
                </th>
                <th width="5%" data-hide="phone,tablet">
                    <?= helper('grid.sort', array('column' => 'last_modified_on', 'title' => 'Last modified')); ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($task as $task): ?>
                <tr>
                    <td>
                        <?= helper('grid.checkbox', array('entity' => $task)) ?>
                    </td>
                    <td>
                        <a href="<?= route('view=task&id='.$task->id); ?>">
                            <?= escape($task->title); ?>
                        </a>
                    </td>
                    <td class="k-nowrap">
                        <?= helper('grid.publish', array('entity' => $task, 'clickable' => true)) ?>
                    </td>
                    <td class="k-nowrap">
                        <?= escape($task->getAuthor()->getName()); ?>
                    </td>
                    <td class="k-nowrap">
                        <?= helper('date.format', array('date' => $task->created_on)); ?>
                    </td>
                </tr>
            <? endforeach; ?>
            </tbody>
        </table>

    </div><!-- .k-table -->

    <? if (count($tasks)): ?>
        <div class="k-table-pagination">
            <?= helper('paginator.pagination') ?>
        </div><!-- .k-table-pagination -->
    <? endif; ?>

</div><!-- .k-table-container -->