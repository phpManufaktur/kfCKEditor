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
use phpManufaktur\Basic\Data\CMS\Page;

class cmsPageLink
{

    public function ControllerDialog(Application $app)
    {
        $Pages = new Page($app);
        $linklist = $Pages->getPageLinkList('page_title');

        $xml = '<data><pageslist>';
        foreach($linklist as $link) {
            $xml .= '<item id="'.CMS_URL.$link['complete_link'].'" value="'.rawurlencode($link['page_title']).'" />';
        }
        $xml .= '</pageslist></data>';
        return new Response($xml, 200, array('Content-Type' => 'application/xml'));
    }
}
