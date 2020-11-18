<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RequestController
{
    private $loader;
    private $twig;

    public function __construct()
    {
        $this->loader = new FilesystemLoader('templates');
        $this->twig = new Environment($this->loader);
    }


    /*** AJAX REQUEST ***/
    public function seeMorePost($maxID = 0){
        $postRepo = new PostRepository;

        if($maxID != 0)
            $posts = $postRepo->getPosts(4, $maxID);
        else
            $posts = $postRepo->getPosts(4);

        $section = "";
        $i = 1;
        $minID;
        foreach ($posts as $post) {
            $id = $post->id;
            $title = $post->title;
            $img = $post->img;
            $extract = $post->extract;
            $section .= "
                        <div class='single single-{$i} col-lg-6' style='background-image:url(\"assets/img/single_post/{$img}\")'>
							<div class='infos'>
								<div>
									<h2>{$title}</h2>
									<p class='extract'>{$extract}</p>
									<a href='article/{$id}' class='btn view-more'>En voir plus</a>
								</div>
							</div>
                        </div>
            ";
            $i++;
            $minID = $id;
        }
        
        if ($i < 4) {
            return json_encode(array('data' => $section, 'minID' => -1));
        }
        else{ 
            return json_encode(array('data' => $section, 'minID' => $minID));
        }
    }

    public function seeCatPost($catID, $maxID = 0){
        $postRepo = new PostRepository;
        if($maxID != 0)
            $posts = $postRepo->getCatPosts($catID, 4, $maxID);
        else
            $posts = $postRepo->getCatPosts($catID, 4);

        $section = "";
        $i = 1;
        $minID;
        foreach ($posts as $post) {
            $id = $post->id;
            $title = $post->title;
            $img = $post->img;
            $extract = $post->extract;
            $section .= "
                        <div class='single single-{$i} col-lg-6' style='background-image:url(\"assets/img/single_post/{$img}\")'>
							<div class='infos'>
								<div>
									<h2>{$title}</h2>
									<p class='extract'>{$extract}</p>
									<a href='article/{$id}' class='btn view-more'>En voir plus</a>
								</div>
							</div>
                        </div>
            ";
            $i++;
            $minID = $id;
        }
        
        if ($i < 4) {
            return json_encode(array('data' => $section, 'minID' => -1));
        }
        else{ 
            return json_encode(array('data' => $section, 'minID' => $minID));
        }
    }

    /*** BAD REQUEST ***/
    public function get404Error()
    {
        return $this->twig->render('website/error_404.html.twig');
    }

}
