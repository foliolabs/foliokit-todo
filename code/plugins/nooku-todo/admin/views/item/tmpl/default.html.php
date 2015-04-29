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

<?= helper('behavior.validator'); ?>

<ktml:toolbar type="actionbar" />

<div class="todo_form_layout koowa admin">
    <form action="" method="post" class="-koowa-form">
        <div class="todo_container">
            <div class="todo_grid">
                <div class="two-thirds">
                    <fieldset>

                        <legend><?= translate('Details') ?></legend>

                        <div class="todo_grid">
                            <div class="control-group two-thirds">
                                <label class="control-label" for="todo_form_title"><?= translate('Title') ?></label>
                                <div class="controls">
                                    <div class="input-group">
                                        <input required class="input-group-form-control" id="todo_form_title" type="text" name="title" maxlength="255"
                                               value="<?= escape($item->title); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="control-group one-third">
                                <label class="control-label" for="todo_form_alias"><?= translate('Alias') ?></label>
                                <div class="controls">
                                    <input id="todo_form_alias" type="text" class="input-block-level" name="slug" maxlength="255"
                                           value="<?= escape($item->slug) ?>" />
                                </div>
                            </div>
                        </div>

                        <legend><?= translate('Description') ?></legend>

                        <div class="todo_grid description_container">
                            <div class="control-group one-whole">
                                <div class="controls">
                                    <?= helper('editor.display', array(
                                        'name'  => 'description',
                                        'value' => $item->description
                                    )); ?>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                </div>
                <div class="one-third">
                    <fieldset>
                        <legend><?= translate('Publishing') ?></legend>
                        <div class="todo_grid">
                            <div class="control-group todo_grid__item one-whole">
                                <label class="control-label"><?= translate('Status'); ?></label>
                                <div class="controls radio btn-group">
                                    <?= helper('select.booleanlist', array(
                                        'name' => 'enabled',
                                        'selected' => $item->enabled,
                                        'true' => translate('Published'),
                                        'false' => translate('Unpublished')
                                    )); ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

    </form>
</div>