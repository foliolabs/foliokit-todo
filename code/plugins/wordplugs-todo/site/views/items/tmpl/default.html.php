<?
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<?= helper('bootstrap.load'); ?>
<?= helper('behavior.koowa');?>
<?= helper('behavior.modal');?>

<? // Toolbar ?>
<ktml:toolbar type="actionbar" title="false" />

<? foreach ($items as $item): ?>
    <? //Import child template from document view ?>
    <?= import('com://site/todo.item.default.html', array(
        'item' => $item,
    )) ?>
<? endforeach ?>