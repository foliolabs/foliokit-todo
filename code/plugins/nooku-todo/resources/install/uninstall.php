<?php

function todo_uninstall()
{
    $result = KObjectManager::getInstance()
                ->getObject('lib:database.adapter.mysqli')
                ->execute(file_get_contents(__DIR__.'/uninstall.sql'), KDatabase::MULTI_QUERY);

    if($result) {
        delete_option('todo_installed');
    }
    else throw new KExceptionError("Failed to run queries from ".__DIR__.'/uninstall.sql');
}