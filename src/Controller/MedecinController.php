<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Form\MedecinType;
use App\Form\ServiceType;
use App\Repository\MedecinRepository;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MedecinController extends AbstractController
{
    /**
     * @Route("/medecin", name="medecin_view")
     */
    public function index(MedecinRepository $ripo)
    {
        $medecins = $ripo->findAll();
        $em = $this->getDoctrine()->getManager();
        $em->getRepository(Medecin::class, $medecins);
        
        $em->flush();
         
        return $this->render('medecin/index.html.twig', [
            'medecins' => $medecins
        ]);
    }
        /**
     * @Route("/medecin/ajout", name="ajouter")
     */
    public function ajout(Request $request){
        $medecinlast = $this->getDernierMed() + 1;
    
            $medecins = new Medecin();
       
       
        $form = $this->createForm(MedecinType::class, $medecins);
        $form ->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $twofirstListter =\strtoupper(\substr($medecins->getService()->getLibelle(),0,2));
            $longId = strlen((string)$medecinlast);
            $matricule = \str_pad("M".$twofirstListter,8 - $longId,"0").$medecinlast;
            $medecins->setMatricule($matricule);
            $em = $this->getDoctrine()->getManager();
            $em->persist($medecins);
            $em->flush();
            return $this->redirectToRoute('medecin_view');
           
        }
        return $this->render('medecin/ajout.html.twig', [
            'ajouterMedecin' => $form->createView()
         ]);
        
    }
    
    public function getDernierMed(){
        $ripo = $this->getDoctrine()->getRepository(Medecin::class);
        $medecinlast = $ripo->findBy([],['id'=>'DESC']);
        if($medecinlast == null){
            return $id = 0;
        }else{
            return  $medecinlast[0]->getId();
        }
        

    }
}
