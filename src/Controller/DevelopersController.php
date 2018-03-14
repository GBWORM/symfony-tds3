<?php
namespace App\Controller;
use App\Entity\Developer;
use App\Repository\DevelopersRepository;
use App\Services\semantic\DevelopersGui;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\semantic\ProjectsGui;
use App\Repository\ProjectRepository;
class DevelopersController extends Controller
{
    public function devs(DevelopersGui $gui,DevelopersRepository $devRepo){
        $devs=$devRepo->findAll();
        $gui->dataTable($devs);
        return $gui->renderView('developers/index.html.twig');
    }
    /**
     * @Route("/developers", name="developers")
     */
    public function index(DevelopersGui $gui, DevelopersRepository $devR)
    {
        $dev=$devR->findAll();
        $dt=$gui->dataTable($dev);
        $gui->getOnClick("#dev-insert","developers/insert","#dev-view",["attr"=>""]);
        return $gui->renderView('developers/index.html.twig',["developers"=>$dev]);
    }
    /**
     * @Route("developers/insert", name="developers_insert")
     */
    public function insert(DevelopersGui $devGui){
        $devGui->frm();
        return $devGui->renderView('developers/frm.html.twig');
    }
    /**
     * @Route("developers/submit", name="developers_submit")
     */
    public function submit(Request $request, DevelopersRepository $devRepo){
        $id=$request->get('id');
        if(!isset($id)) {
            $dev = new Developer();
            $dev->setIdentity($request->get("identity"));
            $devRepo->insert($dev);
        }
        else {
            $dev = $devRepo->find($id);
            $dev->setIdentity($request->get("identity"));
            $devRepo->update($dev);
        }
        return $this->forward("App\Controller\DevelopersController::insert");
    }

    /**
     * @Route("tag/update/{id}", name="tag_update")
     */
    public function update(Developer $dev,DevelopersGui $devsGui){
        $devsGui->frm($dev);
        return $devsGui->renderView('developers/frm_m.html.twig');
    }
}