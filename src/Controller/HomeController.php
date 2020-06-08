<?php

namespace App\Controller;

use App\Entity\Artwork;
use App\Repository\ArtworkRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Permet d'afficher la page d'accueil
     * 
     * @Route("/", name="homepage")
     * 
     * @return Response()
     */
    public function index(ArtworkRepository $repo)
    {
        $artworks = $repo->findBy(
            array('globalRate' => 9),
            array('globalRate' => 'desc'),
            3,
            0
        );

        return $this->render('home/index.html.twig', [
            'artworks' => $artworks
        ]);
    }
}
