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

    <!-- Filters -->
    <div class="k-scopebar__task k-scopebar__task--fluid">

        <!-- Filter title -->
        <div class="k-scopebar__task--title"><?= translate('Filter:'); ?></div>

        <!-- Filters -->
        <div class="k-scopebar__task--filters">
            <ul>
                <li>
                    <button class="k-filter-button" type="button" data-filter-toggle="filter">
                        <?= translate('Status'); ?>
                    </button>
                </li>
            </ul>
        </div>

        <!-- Search toggle button -->
        <button type="button" class="k-toggle-search"><span class="k-icon-magnifying-glass"></span><span class="visually-hidden"><?= translate('Search'); ?></span></button>

    </div>

    <!-- Search -->
    <div class="k-scopebar__task k-scopebar__search">
        <?= helper('grid.search', array('submit_on_clear' => true)) ?>
    </div>

</div><!-- .k-scopebar -->

<!-- filter container -->
<div class="k-filter-container">
    <div class="k-filter-container__task" data-filter="filter">
        <div class="select2-wrapper select2--filter">
            <select name="enabled" id="select2-filter" data-placeholder="Status" onchange="this.form.submit()">
                <option selected>--Status--</option>
                <option value="1"<?= parameters()->enabled === 1 ? ' selected' : ''; ?>>Published</option>
                <option value="0"<?= parameters()->enabled === 0 ? ' selected' : ''; ?>>Unpublished</option>
            </select>
        </div>
    </div>
</div><!-- .k-filter-container -->