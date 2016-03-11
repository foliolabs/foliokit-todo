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
            <? foreach ($items as $item): ?>
                <tr>
                    <td>
                        <?= helper('grid.checkbox', array('entity' => $item)) ?>
                    </td>
                    <td>
                        <a href="<?= route('view=task&id='.$item->id); ?>">
                            <?= escape($item->title); ?>
                        </a>
                    </td>
                    <td class="k-nowrap">
                        <?= helper('grid.publish', array('entity' => $item, 'clickable' => true)) ?>
                    </td>
                    <td class="k-nowrap">
                        <?= escape($item->getAuthor()->getName()); ?>
                    </td>
                    <td class="k-nowrap">
                        <?= helper('date.format', array('date' => $item->created_on)); ?>
                    </td>
                </tr>
            <? endforeach; ?>
            </tbody>
        </table>

    </div><!-- .k-table -->

    <? if (count($items)): ?>
        <div class="k-table-pagination">
            <?= helper('paginator.pagination') ?>
        </div><!-- .k-table-pagination -->
    <? endif; ?>

</div><!-- .k-table-container -->