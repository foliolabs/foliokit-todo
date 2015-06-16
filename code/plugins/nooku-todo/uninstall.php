<?php

if(WP_UNINSTALL_PLUGIN) {
    KObjectManager::getInstance()->getObject('com:todo.installer', array(
        'basepath' => __DIR__
    ))->uninstall();
}