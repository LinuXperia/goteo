<?php

namespace Goteo\Controller {

    use Goteo\Model,
        Goteo\Library;

    class Rss extends \Goteo\Core\Controller {

        public function __construct() {
            //activamos la cache para todo el controlador index
            \Goteo\Core\DB::cache(true);
        }

        public function index () {

            // sacamos su blog
            $blog = Model\Blog::get(\GOTEO_NODE, 'node');

            $tags = Model\Blog\Post\Tag::getAll();

            /*
            echo '<pre>'.print_r($tags, true).'</pre>';
            echo '<pre>'.print_r($blog->posts, true).'</pre>';
            die;
             *
             */

            // al ser xml no usaremos vista
            // usaremos FeedWriter

            // configuracion
            $config = array(
                'title' => 'Goteo Rss',
                'description' => 'Blog Goteo.org rss',
                'link' => SITE_URL,
                'indent' => 6
            );

            $data = array(
                'tags' => $tags,
                'posts' => $blog->posts
            );

            \header("Content-Type: application/rss+xml");
            echo Library\Rss::get($config, $data, $_GET['format']);

            // le preparamos los datos y se los pasamos
        }

    }

}