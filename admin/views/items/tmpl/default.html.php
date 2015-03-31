<?
/**
 * Todo - a Joomla example extension built with Nooku Framework.
 *
 * @package     Todo
 * @copyright   Copyright (C) 2011 - 2014 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/joomla-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<?php if(count($items)): ?>
    <ul>
    <?php foreach($items as $item) : ?>
        <li><input type="checkbox" name="item[]" value="<?=$item->id?>" /><a href="<?=@route('&page=todo-items&view=item&id='.$item->id)?>"><?=$item->title?></a></li>
    <?php endforeach?>
    </ul>
<?php else: ?>
No items found
<?php endif ?>