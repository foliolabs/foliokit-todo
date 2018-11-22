<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */


return [
    'identifiers' => [
        'com:base.controller.page' => [
            'shortcodes' => [
                'com:base.shortcode' => ['code' => 'foliolabs-todo', 'attributes' => ['component' => 'todo']]
            ]
        ]
    ]
];