<?
/**
 * @package     DOCman
 * @copyright   Copyright (C) 2011 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */
defined('KODEKIT') or die; ?>


<? // Loading necessary Markup, CSS and JS ?>
<?= helper('ui.load') ?>


<?= helper('behavior.keepalive'); ?>
<?= helper('behavior.validator'); ?>


<!-- Wrapper -->
<div class="k-wrapper k-js-wrapper">

    <!-- Overview -->
    <div class="k-content-wrapper">

        <!-- Content -->
        <div class="k-content k-js-content">

            <!-- Toolbar -->
            <ktml:toolbar type="actionbar">

                <!-- Component wrapper -->
                <div class="k-component-wrapper">

                    <!-- Component -->
                    <form class="k-component k-js-component k-js-form-controller" action="" method="post">

                        <!-- Container -->
                        <div class="k-container">

                            <!-- Main information -->
                            <div class="k-container__main">

                                <fieldset>

                                    <div class="k-form-group">
                                        <div class="k-input-group k-input-group--large">
                                            <input required
                                                   id="docman_form_title"
                                                   class="k-form-control"
                                                   type="text"
                                                   name="title"
                                                   maxlength="255"
                                                   value="<?= escape($task->title) ?>"/>
                                        </div>
                                    </div>

                                    <div class="k-form-group">
                                        <div class="k-input-group k-input-group--small">
                                            <label for="docman_form_alias" class="k-input-group__addon">
                                                <?= translate('Alias') ?>
                                            </label>
                                            <input id="docman_form_alias"
                                                   type="text"
                                                   class="k-form-control"
                                                   name="slug"
                                                   maxlength="255"
                                                   value="<?= escape($task->slug) ?>"
                                                   placeholder="Will be created automatically" />
                                        </div>
                                    </div>

                                    <div class="k-form-group">
                                        <?= helper('editor.display', array(
                                            'name' => 'description',
                                            'value' => $task->description
                                        )); ?>
                                    </div>

                                </fieldset>

                            </div><!-- .k-container__main -->


                            <!-- Other information -->
                            <div class="k-container__sub">

                                <fieldset class="k-form-block">

                                    <div class="k-form-block__header">
                                        <?= translate('Publishing') ?>
                                    </div>

                                    <div class="k-form-block__content">

                                        <div class="k-form-group">
                                            <label><?= translate('Status'); ?></label>
                                            <?= helper('select.booleanlist', array(
                                                'name' => 'enabled',
                                                'selected' => $task->enabled,
                                                'true' => 'Published',
                                                'false' => 'Unpublished'
                                            )); ?>
                                        </div>

                                        <div class="k-form-group">
                                            <label><?= translate('Date'); ?></label>
                                            <?= helper('behavior.calendar', array(
                                                'name' => 'created_on',
                                                'id' => 'created_on',
                                                'value' => $task->created_on,
                                                'format' => '%Y-%m-%d %H:%M:%S',
                                                'filter' => 'user_utc'
                                            ))?>
                                        </div>

                                    </div>

                                </fieldset>

                                <fieldset class="k-form-block">

                                    <div class="k-form-block__header">
                                        <?= translate('Permissions') ?>
                                    </div>

                                    <div class="k-form-block__content">

                                        <div class="k-form-group">
                                            <label><?= translate('Owner'); ?></label>
                                            <?= helper('listbox.users', array(
                                                'name' => 'created_by',
                                                'selected' => $task->created_by ? $task->created_by : object('user')->getId(),
                                                'deselect' => false,
                                                'attribs' => array('class' => 'input-block-level select2-users-listbox'),
                                                'select2' => true,
                                                'select2_options' => array('element' => '.select2-users-listbox')
                                            )) ?>
                                        </div>

                                    </div>
                                </fieldset>

                            </div><!-- .k-container__sub -->

                        </div><!-- .k-container -->

                    </form><!-- .k-component -->

                </div><!-- .k-component-wrapper -->

        </div><!-- .k-content -->

    </div><!-- .k-content-wrapper -->

</div><!-- .k-wrapper -->
