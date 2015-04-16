<?
/**
 * Todo Plugin for Wordpress
 *
 * @copyright   Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/wordpress-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<ktml:style src="media://css/koowa.css" />
<ktml:style src="media://todo/css/site.css" />

<?= helper('bootstrap.load'); ?>
<?= helper('behavior.koowa'); ?>
<?= helper('behavior.validator'); ?>

<? // Toolbar ?>
<div class="koowa_toolbar">
    <ktml:toolbar type="actionbar">
</div>

<? // Form ?>
<div class="koowa_form">
    <div class="todo_form_layout">
        <form action="<?= route('id='. $item->id) ?>" method="post" class="-koowa-form">

            <div class="todo_container">
                <div class="todo_grid">
                    <div class="todo_grid__item two-thirds">

                        <? // Details fieldset ?>
                        <fieldset>
                            <legend><?= translate('Details') ?></legend>

                            <?= import('com://site/todo.item.form_details.html') ?>

                        </fieldset>

                        <? // Description fieldset ?>
                        <fieldset>
                            <legend><?= translate('Description') ?></legend>

                            <?= import('com://site/todo.item.form_description.html') ?>

                        </fieldset>
                    </div>

                    <div class="todo_grid__item one-third">
                        <? // Publishing fieldset ?>
                        <fieldset>
                            <legend><?= translate('Publishing') ?></legend>

                            <?= import('com://site/todo.item.form_publishing.html') ?>

                        </fieldset>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>