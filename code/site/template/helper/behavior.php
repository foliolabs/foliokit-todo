<?php
/**
 * Todo - Wordpress example plugin built with FolioKit
 *
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/foliolabs/foliolabs-todo for the canonical source repository
 */
namespace Foliolabs\Todo\Site;
use Foliolabs\Component\Base;
use Kodekit\Library;

class TemplateHelperBehavior extends Base\TemplateHelperBehavior
{
    /**
     * Makes links delete actions
     *
     * Used in frontend delete buttons
     *
     * @param array $config
     * @return string
     */
    public function deletable($config = array())
    {
        $config = new Library\ObjectConfigJson($config);
        $config->append(array(
            'selector' => '.todo-deletable',
            'confirm_message' => $this->getObject('translator')->translate(
                'You will not be able to bring this task back if you delete it. Would you like to continue?'
            ),
        ));

        $html = $this->kodekit();

        $signature = md5(serialize(array($config->selector,$config->confirm_message)));
        if (!isset(self::$_loaded[$signature])) {
            $html .= "
            <script>
            kQuery(function($) {
                $('{$config->selector}').on('click', function(event){
                    event.preventDefault();

                    var target = $(event.target);

                    if (!target.hasClass('disabled') && confirm('{$config->confirm_message}')) {
                        new Kodekit.Form($.parseJSON(target.prop('rel'))).submit();
                    }
                });
            });
            </script>
            ";

            self::$_loaded[$signature] = true;
        }

        return $html;
    }
}
