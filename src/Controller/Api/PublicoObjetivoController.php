<?php

namespace App\Controller\Api;

use App\Entity\PublicoObjetivo;
use App\Form\PublicoObjetivoType;
use App\Repository\PublicoObjetivoRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/publico_objetivo")
 */
class PublicoObjetivoController extends AbstractFOSRestController
{

    //CRUD -> Create(1), Read(2), Update(3), Delete(4)

    private $repo;

    public function __construct(PublicoObjetivoRepository $repo)
    {
        $this->repo = $repo;
    }

    #1
    /**
     * @Rest\Post(path="/")
     * @Rest\View(serializerGroups={"p_objetivo"}, serializerEnableMaxDepthChecks=true)
     */
    public function createPublicoObjetivoAction(Request $request){
        $pObjetivo = new PublicoObjetivo();
        $form = $this->createForm(PublicoObjetivoType::class, $pObjetivo);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()){
            return $form;
        }
        $this->repo->add($pObjetivo,true);
        return $pObjetivo;
    }

    #2
    /**
     * @Rest\Get(path="/")
     * @Rest\View(serializerGroups={"p_objetivo"}, serializerEnableMaxDepthChecks=true)
     */
    public function getPublicosObjetivoAction(){
        return $this->repo->findAll();
    }

    #2
    /**
     * @Rest\Get(path="/{id}")
     * @Rest\View(serializerGroups={"p_objetivo"}, serializerEnableMaxDepthChecks=true)
     */
    public function getPublicoObjetivoAction(Request $request){
        $id = $this->repo->find($request->get('id'));
        if (!$id){
            return new JsonResponse('No se ha encontrado el público objetivo', 404);
        }
        return $id;
    }

    #3
    /**
     * @Rest\Patch(path="/{id}")
     * @Rest\View(serializerGroups={"p_objetivo"}, serializerEnableMaxDepthChecks=true)
     */
    public function updatePublicoObjetivoAction(Request $request){
        $id = $request->get('id');
        $pObjetivo = $this->repo->find($id);
        if (!$pObjetivo){
            return new JsonResponse('No se ha encontrado el público objetivo', 404);
        }
        $form = $this->createForm(PublicoObjetivoType::class, $pObjetivo, ['method'=>$request->getMethod()]);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()){
            return new JsonResponse('Bad data', 400);
        }
        $this->repo->add($pObjetivo,true);
        return $pObjetivo;
    }

    #4
    /**
     * @Rest\Delete(path="/{id}")
     */
    public function deletePublicoObjetivoAction(Request $request){
        $id = $request->get('id');
        $pObjetivo = $this->repo->find($id);
        if (!$pObjetivo){
            return new JsonResponse('No se ha encontrado el público objetivo', 404);
        }
        $this->repo->remove($pObjetivo,true);
        return new JsonResponse('¡Público objetivo borrado!', 200);
    }
}
