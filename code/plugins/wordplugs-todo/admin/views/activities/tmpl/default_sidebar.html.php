<?
/**
 * Todo Plugin for Wordpress
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/wordpress-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<div id="k-sidebar" class="k-sidebar">

    <!-- Navigation -->
    <div class="k-sidebar__navigation">
        <ktml:toolbar type="menubar">
    </div>

    <!-- Filters -->
    <div class="k-sidebar__item">
        <div class="k-sidebar__content">
            <ul class="k-list">
                <li class="<?= is_null(parameters()->user) ? 'active' : ''; ?>">
                    <a href="<?= route('user=') ?>">
                        <span class="k-icon-list"></span>
                        All activities
                    </a>
                </li>
                <li class="<?= parameters()->user ? 'active' : ''; ?>">
                    <a href="<?= route('user='.object('user')->getId()) ?>">
                        <span class="k-icon-person"></span>
                        My activities
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div><!-- .k-sidebar -->