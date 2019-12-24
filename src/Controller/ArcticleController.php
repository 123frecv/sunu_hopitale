<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArcticleController extends AbstractController
{
    /**
     * @Route("/arcticle", name="arcticle")
     */
    public function index()
    {
        return $this->render('arcticle/index.html.twig', [
            'controller_name' => 'ArcticleController',
        ]);
    }
    /**
     * @Route("/arcticle/home", name="arcticle_home")
     */
    public function home(){
        return $this->render('arcticle/home.html.twig');
    }
}
