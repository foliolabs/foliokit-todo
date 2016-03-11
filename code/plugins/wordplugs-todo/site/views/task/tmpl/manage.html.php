<?
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

defined('KOOWA') or die;

$button_size   = 'btn-small';
?>

<? // Edit and delete buttons ?>
<? if (!($task->isLockable() && $task->isLocked()) && (can('edit') || can('delete'))): ?>
<div class="btn-toolbar koowa_toolbar">
        <div class="btn-group">

        <? // Edit ?>
        <? if (can('edit')): ?>
            <a class="btn <?= $button_size ?>" href="<?= route('view=task&id='.$task->id.'&layout=form')?>"><?= translate('Edit'); ?></a>
        <? endif ?>

        <? // Delete ?>
        <? if (can('delete')):
            $data = array(
                'method' => 'post',
                'url'    => (string)route('view=task&id='.$task->id),
                'params' => array(
                    'csrf_token' => object('user')->getSession()->getToken(),
                    '_action'    => 'delete',
                    '_referrer'  => base64_encode((string) object('request')->getUrl())
                )
            );

            if (parameters()->view == 'task')
            {
                if ((string)object('request')->getReferrer()) {
                    $data['params']['_referrer'] = base64_encode((string) object('request')->getReferrer());
                } else {
                    $data['params']['_referrer'] = base64_encode(object('request')->getSiteUrl());
                }
            }
        ?>
            <?= helper('behavior.deletable'); ?>
            <a class="btn <?= $button_size ?> btn-danger todo-deletable" href="#" rel="<?= escape(json_encode($data)) ?>"><?= translate('Delete') ?></a>
        <? endif ?>
    </div>
</div>
<? endif ?>
