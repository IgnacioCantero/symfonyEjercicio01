<?php

namespace App\Controller\Api;

use App\Entity\Juguetes;
use App\Form\JugueteType;
use App\Repository\JuguetesRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/juguete")
 */
class JugueteController extends AbstractFOSRestController
{

    //CRUD -> Create(1), Read(2), Update(3), Delete(4)

    private $repo;

    public function __construct(JuguetesRepository $repo)
    {
        $this->repo = $repo;
    }

    #1
    /**
     * @Rest\Post (path="")
     * @Rest\View (serializerGroups={"juguete"}, serializerEnableMaxDepthChecks=true)
     */
    public function createJugueteAction(Request $request){
        $juguete = new Juguetes();
        $form = $this->createForm(JugueteType::class, $juguete);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()){
            return $form;
        }
        $this->repo->add($juguete, true);
        return $juguete;
    }

    #2
    /**
     * @Rest\Get (path="")
     * @Rest\View (serializerGroups={"juguete"}, serializerEnableMaxDepthChecks=true)
     */
    public function getJuguetesAction(){
        return $this->repo->findAll();
    }

    #2
    /**
     * @Rest\Get (path="/{id}")
     * @Rest\View (serializerGroups={"juguete"}, serializerEnableMaxDepthChecks=true)
     */
    public function getJugueteAction(Request $request){
        $juguete = $this->repo->find($request->get('id'));
        if (!$juguete){
            return new JsonResponse('No se ha encontrado el juguete', 404);
        }
        return $juguete;
    }

    #3
    /**
     * @Rest\Patch (path="/{id}")
     * @Rest\View (serializerGroups={"juguete"}, serializerEnableMaxDepthChecks=true)
     */
    public function updateJugueteAction(Request $request){
        $juguete = $this->repo->find($request->get('id'));
        if (!$juguete){
            return new JsonResponse('No se ha encontrado el juguete', 404);
        }
        $form = $this->createForm(JugueteType::class, $juguete, ['method'=>$request->getMethod()]);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return new JsonResponse('Bad data', 400);
        }
        $this->repo->add($juguete, true);
        return $juguete;
    }

    #4
    /**
     * @Rest\Delete (path="/{id}")
     */
    public function deleteJugueteAction(Request $request){
        $juguete = $this->repo->find($request->get('id'));
        if (!$juguete){
            return new JsonResponse('No se ha encontrado el juguete', 404);
        }
        $this->repo->remove($juguete, true);
        return new JsonResponse('¡Juguete borrado satisfactoriamente!', 200);
    }
}
