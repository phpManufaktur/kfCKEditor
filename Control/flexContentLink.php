<?php

/**
 * kfCKEditor
 *
 * @author Team phpManufaktur <team@phpmanufaktur.de>
 * @link https://addons.phpmanufaktur.de/flexContent
 * @copyright 2014 Ralf Hertsch <ralf.hertsch@phpmanufaktur.de>
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */

namespace phpManufaktur\CKEditor\Control;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use phpManufaktur\flexContent\Data\Content\Content;
use phpManufaktur\flexContent\Control\Command\Tools;

class flexContentLink
{

    public function ControllerDialog(Application $app)
    {
        $language = $app['session']->get('FLEXCONTENT_EDIT_CONTENT_LANGUAGE', null);

        $Content = new Content($app);
        $linklist = $Content->selectContentLinkList($language);

        $Tools = new Tools($app);

        $xml = '<data><pageslist>';

        if (is_array($linklist)) {
            foreach ($linklist as $link) {
                if (empty($link['redirect_url'])) {
                    $permalink_base = $Tools->getPermalinkBaseURL($link['language']);
                    $url = $permalink_base.'/'.$link['permalink'];
                }
                else {
                    $url = $link['redirect_url'];
                }
                $xml .= '<item id="'.$url.'" value="'.rawurlencode($link['title']).'" />';
            }
        }
        $xml .= '</pageslist></data>';
        return new Response($xml, 200, array('Content-Type' => 'application/xml'));
    }
}
