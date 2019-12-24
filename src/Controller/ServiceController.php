<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="service")
     */
    public function index(ServiceRepository $ripo)
    {
        
        $services = $ripo->findAll();
        $em = $this->getDoctrine()->getManager();
        $em->getRepository(Service::class, $services);
        
        $em->flush();
         
        return $this->render('service/index.html.twig', [
            'services' => $services
        ]);
    }
        /**
     * @Route("/service/ajout", name="service_ajout")
     * @Route("/service/service_mod/{{id}}", name="service_mod")
     */
    public function serviceajouter(Request $request,Service $services = null)
    {
        if(!$services){
            $services = new Service();
        }
       
        $form = $this->createForm(ServiceType::class, $services);
        $form ->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
  
            $em = $this->getDoctrine()->getManager();
            $em->persist($services);
            $em->flush();
            return $this->redirectToRoute('service');
           
        }
        return $this->render('service/ajouter.html.twig', [
            'ajouterService' => $form->createView()
         ]);
    }
    /**
     * @route("/service/service_sup/{id}", name="service_sup")
     */
    public function delete($id,ServiceRepository $ripo){
        $services = $ripo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->getRepository(Service::class, $services);
        $em->remove($services);
        $em->flush();
        return $this->redirectToRoute('service');
        }
}
  
