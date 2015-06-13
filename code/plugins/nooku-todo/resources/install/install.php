<?php

function todo_install()
{
    if(is_plugin_active('koowa/koowa.php'))
    {
        $installed = get_option('todo_installed');

        if(!$installed)
        {
            $result = KObjectManager::getInstance()
                        ->getObject('lib:database.adapter.mysqli')
                        ->execute(file_get_contents(__DIR__.'/install.sql'), KDatabase::MULTI_QUERY);

            if($result) {
                add_option('todo_installed', true);
            }
            else throw new KExceptionError("Failed to run queries from ".__DIR__.'/install.sql');
        }
    }
    // TODO: Gracefully inform that Nooku is required.
    else throw new ErrorException("Nooku Framework is required!");
}