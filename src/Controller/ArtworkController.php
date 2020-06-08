<?php

namespace App\Controller;

use App\Entity\Artwork;
use Pagerfanta\Pagerfanta;
use App\Entity\DiscussionTheme;
use Pagerfanta\Adapter\ArrayAdapter;
use App\Repository\ArtworkRepository;
use App\Repository\DiscussionThemeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArtworkController extends AbstractController
{
    /**
     * @Route("/artworks", name="artworks_index")
     */
    public function index(ArtworkRepository $repo, PaginatorInterface $paginator, Request $request)
    {

        $artworks = $paginator->paginate(
            $repo->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6); /*limit per page*/

        return $this->render('artwork/index.html.twig', [
            'artworks' => $artworks
        ]);
    }

    /**
     * Permet d'afficher la page d'une oeuvre
     * 
     *@Route("/artworks/{slug}", name="artwork_show")

     * @return Response
     */
    public function show(Artwork $artwork, DiscussionThemeRepository $repo, PaginatorInterface $paginator, Request $request){
        $discussionTheme = $paginator->paginate(
            $repo->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6); /*limit per page*/

        return $this->render('artwork/show.html.twig', [
            'artwork' => $artwork
            // 'discussionTheme' => $discussionTheme
        ]);
    }

    /**
     * Permet d'afficher la page ciblant la catégorie de débat d'une oeuvre
     * 
     * @Route("/artworks/{slug}/{themeSlug}", name="artwork_discussionTheme_show")
     *
     * @return Response
     */
    public function discussionThemeShow(Artwork $artwork, DiscussionTheme $discussionTheme){
        return $this->render('artwork/discussionThemeShow.html.twig', [
            'artwork' => $artwork,
            'discussionTheme' => $discussionTheme
        ]);
    }
}
