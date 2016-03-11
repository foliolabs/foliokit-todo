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
        <table class="table--fixed">
            <thead>
            <tr>
                <th width="1%">
                    <?= helper('grid.checkall')?>
                </th>
                <th>
                    <?= translate('Message'); ?>
                </th>
                <th width="30%">
                    <?= helper('grid.sort', array('column' => 'created_on', 'title' => 'Time')); ?>
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
                        <?= helper('com:activities.activity.activity', array('entity' => $item)) ?>
                    </td>
                    <td>
                        <?= helper('date.humanize', array('date' => $item->created_on)); ?>
                    </td>
                </tr>
            <? endforeach; ?>

            <? if (!count($items)) : ?>
                <tr>
                    <td colspan="9">
                        <?= translate('No activities found.') ?>
                    </td>
                </tr>
            <? endif; ?>
            </tbody>
        </table>

    </div><!-- .k-table -->

    <? if (count($items)): ?>
        <div class="k-table-pagination">
            <?= helper('paginator.pagination') ?>
        </div><!-- .k-table-pagination -->
    <? endif; ?>

</div><!-- .k-table-container -->