<?php
/**
 * Created by PhpStorm.
 * User: Gabin Challe
 * Date: 28/02/2018
 * Time: 10:06
 */

namespace App\Controller;


use App\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\TagRepository;
use App\Services\semantic\TagsGui;

class TagsController extends Controller{

    /**
     * @Route("/tags", name="tags")
     */
    public function index(TagsGui $gui,TagRepository $tagRepo){
        $tags=$tagRepo->findAll();
        $dt=$gui->dataTable($tags);
        return new Response($dt);
    }

    /**
     * @Route("tag/update/{id}", name="tag_update")
     */
    public function update(Tag $tag,TagsGui $tagsGui){
        $tagsGui->frm($tag);
        return $tagsGui->renderView('Tags/frm.html.twig');
    }

    /**
     * @Route("/tags", name="tags")
     */
    public function tags(TagsGui $gui,TagRepository $tagRepo){
        $tags=$tagRepo->findAll();
        $gui->dataTable($tags);
        return $gui->renderView('Tags/index.html.twig');;
    }

    /**
     * @Route("tag/submit", name="tag_submit")
     */
    public function submit(Request $request,TagRepository $tagRepo){
        $tag=$tagRepo->find($request->get("id"));
        if(isset($tag)){
            $tag->setTitle($request->get("title"));
            $tag->setColor($request->get("color"));
            $tagRepo->update($tag);
        }
        return $this->forward("App\Controller\TagsController::tags");
    }
}