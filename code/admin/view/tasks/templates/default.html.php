<?
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

defined('KODEKIT') or die; ?>

<?= helper('ui.load') ?>

<!-- Wrapper -->
<div class="k-wrapper k-js-wrapper">

    <!-- Title when sidebar is invisible -->
    <ktml:toolbar type="titlebar" title="COM_DOCMAN_SUBMENU_CATEGORIES" mobile>

        <!-- Overview -->
        <div class="k-content-wrapper">

            <!-- Sidebar -->
            <?='' /* import('default_sidebar.html'); */ ?>

            <!-- Content -->
            <div class="k-content k-js-content">

                <!-- Toolbar -->
                <ktml:toolbar type="actionbar">

                    <!-- Component wrapper -->
                    <div class="k-component-wrapper">

                        <!-- Component -->
                        <form class="k-component k-js-component k-js-grid-controller" action="" method="get">

                            <!-- Scopebar -->
                            <?= import('default_scopebar.html'); ?>

                            <!-- Check for categories -->
                            <? if(!count($tasks)) : ?>

                                <!-- No categories -->
                                <?= import('no_tasks.html'); ?>

                            <? else : ?>

                                <!-- Table -->
                                <?= import('default_table.html'); ?>

                            <? endif; ?>

                        </form><!-- .k-component -->

                    </div><!-- .k-component-wrapper -->

            </div><!-- k-content -->

        </div><!-- .k-content-wrapper -->

</div><!-- .k-wrapper -->