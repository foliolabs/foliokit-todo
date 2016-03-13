<?php
/**
 * Todo - Wordpress example plugin built with Wordplugs Framework
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/wordplugs/wordplugs-todo for the canonical source repository
 */

function todo_install()
{
    if(is_plugin_active('wordplugs-framework/wordplugs-framework.php'))
    {
        $installed = get_option('todo_installed');

        if(!$installed)
        {
            $result = KObjectManager::getInstance()
                        ->getObject('lib:database.adapter.mysqli')
                        ->execute(file_get_contents(__DIR__.'/install.sql'), KDatabase::MULTI_QUERY);

            if($result) {
                add_option('todo_installed', true);
            } else {
                throw new KExceptionError("Failed to run queries from ".__DIR__.'/install.sql');
            }
        }
    }
    else wp_die("Wordplugs Framework is required!");
}