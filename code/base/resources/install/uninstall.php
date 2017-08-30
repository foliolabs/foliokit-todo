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
    $result = \Kodekit::getObject('database.driver.mysqli')
                ->execute(file_get_contents(__DIR__.'/uninstall.sql'), \Kodekit\Library\Database::MULTI_QUERY);

    if($result) {
        delete_option('todo_installed');
    } else {
        throw new \RuntimeException("Failed to run queries from ".__DIR__.'/uninstall.sql');
    }
}