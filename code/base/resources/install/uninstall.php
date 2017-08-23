<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */

function todo_uninstall()
{
    $result = KObjectManager::getInstance()
                ->getObject('lib:database.adapter.mysqli')
                ->execute(file_get_contents(__DIR__.'/uninstall.sql'), KDatabase::MULTI_QUERY);

    if($result) {
        delete_option('todo_installed');
    } else {
        throw new KExceptionError("Failed to run queries from ".__DIR__.'/uninstall.sql');
    }
}