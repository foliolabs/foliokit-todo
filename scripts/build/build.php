#!/usr/bin/env php
<?php

$name = 'foliolabs-todo';

$tmp = __DIR__.'/'.$name;
if (is_dir($tmp)) {
    `rm -rf $tmp`;
}

$plugin_source = realpath('../../code');
$framework_source = realpath('../../../foliokit/code');

`mkdir $tmp`;
`cp -r $plugin_source/* $tmp/`;
`cp -r $framework_source $tmp/framework`;

file_put_contents($tmp.'/framework/foliokit.php', base64_encode(file_get_contents($tmp.'/framework/foliokit.php')));

`zip -r $name.zip $name`;
`rm -rf $tmp`;