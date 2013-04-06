<?php

/**
 * CKEditor extension for the kitFramework
 *
 * @author Team phpManufaktur <team@phpmanufaktur.de>
 * @link https://addons.phpmanufaktur.de/kfCKEditor
 * @copyright 2013 Ralf Hertsch <ralf.hertsch@phpmanufaktur.de>
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */


// add the function CKEditor to Twig
$app['twig'] = $app->share($app->extend('twig', function  ($twig, $app) {

    $twig->addFunction(new Twig_SimpleFunction('CKEditor', function ($id, $name, $content) {

        $framework_url = FRAMEWORK_URL;
        $image_url = FRAMEWORK_URL.'/admin/mediabrowser/cke';

        return <<<EOD
        <textarea id="$id" name="$name">$content</textarea>
        <script>
          CKEDITOR.replace('$id', {
            baseHref: '$framework_url',
            filebrowserImageBrowseUrl: '$image_url',
            filebrowserWindowWidth: 900,
            filebrowserWindowHeight: 600
          });
        </script>
EOD;
        }));
    return $twig;

}));