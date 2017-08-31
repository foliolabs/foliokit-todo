<?
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

defined('KODEKIT') or die; ?>

<?= helper('behavior.bootstrap'); ?>
<?= helper('behavior.kodekit');?>
<?= helper('behavior.modal');?>

<? // Toolbar ?>
<ktml:toolbar type="actionbar" title="false" />

<? foreach ($tasks as $task): ?>
    <? //Import child template from document view ?>
    <?= import('com://site/todo/task/default.html', array('task' => $task)) ?>
<? endforeach ?>