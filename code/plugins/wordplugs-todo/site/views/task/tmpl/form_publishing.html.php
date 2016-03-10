<?
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<? // Status field ?>
<div class="todo_grid">
    <div class="control-group todo_grid__task one-whole">
        <label class="control-label"><?= translate('Status'); ?></label>
        <div class="controls radio btn-group">
            <?= helper('select.booleanlist', array(
                'name' => 'enabled',
                'selected' => $task->enabled,
                'true' => translate('Published'),
                'false' => translate('Unpublished')
            )); ?>
        </div>
    </div>
</div>