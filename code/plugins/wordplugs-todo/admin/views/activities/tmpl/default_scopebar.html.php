<?
/**
 * Todo Plugin for Wordpress
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/wordpress-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<div class="k-scopebar">

    <!-- Filter title -->
    <div class="k-scopebar__item k-scopebar__item--title">Filter:</div>

    <!-- Filters -->
    <div class="k-scopebar__item k-scopebar__item--fluid">

        <!-- Filter -->
        <div class="select2-wrapper select2--link-style select2--filter">
            <select name="action" id="select2-filter" data-placeholder="Action" onchange="this.form.submit()">
                <option selected>--Status--</option>
                <option value="add"<?= parameters()->action == 'add' ? ' selected' : ''; ?>>Created</option>
                <option value="edit"<?= parameters()->action == 'edit' ? ' selected' : ''; ?>>Edited</option>
                <option value="delete"<?= parameters()->action == 'delete' ? ' selected' : ''; ?>>Deleted</option>
            </select>
        </div>

        <!-- Search toggle button -->
        <button type="button" class="toggle-search"><span class="k-icon-magnifying-glass"></span><span class="visually-hidden">Search</span></button>

    </div>

    <!-- Search -->
    <div class="k-scopebar__item k-scopebar__search">
        <?= helper('grid.search', array('submit_on_clear' => true)) ?>
    </div>

</div><!-- .k-scopebar -->