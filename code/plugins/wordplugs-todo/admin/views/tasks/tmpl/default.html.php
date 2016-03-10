<?
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<ktml:style src="assets://css/koowa.css" />

<?= helper('behavior.koowa') ?>

<ktml:toolbar type="actionbar" />

<div class="wrap todo-container koowa admin">
    <h2><?= translate('Todo Tasks') ?></h2>
    <div class="todo_admin_list_grid">
        <form action="" method="get" class="-koowa-grid">
            <div class="scopebar">
                <div class="scopebar-group hidden-tablet hidden-phone">
                    <a class="<?= is_null(parameters()->enabled) ? 'active' : ''; ?>"
                       href="<?= route('enabled=&search=' ) ?>">
                        <?= translate('All') ?>
                    </a>
                </div>
                <div class="scopebar-group last hidden-tablet hidden-phone">
                    <a class="<?= parameters()->enabled === 0 ? 'active' : ''; ?>"
                       href="<?= route('enabled='.(parameters()->enabled === 0 ? '' : '0')) ?>">
                        <?= translate('Unpublished') ?>
                    </a>
                    <a class="<?= parameters()->enabled === 1 ? 'active' : ''; ?>"
                       href="<?= route('enabled='.(parameters()->enabled === 1 ? '' : '1')) ?>">
                        <?= translate('Published') ?>
                    </a>
                </div>
                <div class="scopebar-search">
                    <?= helper('grid.search', array('submit_on_clear' => true)) ?>
                </div>
            </div>
            <div class="todo_table_container">
                <table class="table table-striped footable">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="1">
                            <?= helper('grid.checkall')?>
                        </th>
                        <th class="todo_table__title_field">
                            <?= helper('grid.sort', array('column' => 'title', 'title' => 'Title')); ?>
                        </th>
                        <th width="5%" data-hide="phone,phablet">
                            <?= helper('grid.sort', array('column' => 'enabled', 'title' => 'Status')); ?>
                        </th>
                        <th width="5%" data-hide="phone,phablet,tablet">
                            <?= helper('grid.sort', array('column' => 'created_by', 'title' => 'Owner')); ?>
                        </th>
                        <th width="5%" data-hide="phone,phablet">
                            <?= helper('grid.sort', array('column' => 'created_on', 'title' => 'Date')); ?>
                        </th>
                    </tr>
                </thead>
                <? if (count($tasks)): ?>
                <tfoot>
                    <tr>
                        <td colspan="9">
                            <?= helper('paginator.pagination') ?>
                        </td>
                    </tr>
                </tfoot>
                <? endif; ?>
                <tbody>
                    <? foreach ($tasks as $task): ?>
                    <tr>
                        <td style="text-align: center;">
                            <?= helper('grid.checkbox', array('entity' => $task)) ?>
                        </td>
                        <td class="todo_table__title_field">
                            <a href="<?= route('view=task&id='.$task->id); ?>">
                                <?= escape($task->title); ?></a>
                        </td>
                        <td style="text-align: center">
                            <?= helper('grid.publish', array('entity' => $task, 'clickable' => true)) ?>
                        </td>
                        <td>
                            <?= escape($task->getAuthor()->getName()); ?>
                        </td>
                        <td>
                            <?= helper('date.format', array('date' => $task->created_on)); ?>
                        </td>
                    </tr>
                    <? endforeach; ?>

                    <? if (!count($tasks)) : ?>
                    <tr>
                        <td colspan="9" align="center" style="text-align: center;">
                            <?= translate('No tasks found.') ?>
                        </td>
                    </tr>
                    <? endif; ?>
                </tbody>
            </table>
            </div>
        </form>
    </div>
</div>