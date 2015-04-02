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

<h2><?if($item->id):?>Edit <?=$item->title?> <?else:?>New Todo<?endif?></h2>

<form action="<?=@route('&page=todo-items&component=todo&view=items&id='.$item->id)?>" method="post" class="-koowa-form">
<div>
    <label>Todo <input type="text" name="title" value="<?=$item->title?>" size="100" /></label>
    <div><input type="submit" name="submittodo" value="Save" /></div>
</div>
</form>