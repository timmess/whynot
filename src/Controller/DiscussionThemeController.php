<?php

namespace App\Controller;

use App\Entity\DiscussionTheme;
use App\Repository\DiscussionThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DiscussionThemeController extends AbstractController
{
    /**
     * @Route("/theme", name="discussion_theme")
     */
    public function index(DiscussionThemeRepository $repo)
    {
        $discussionThemes = $repo->findAll();

        return $this->render('discussion_theme/index.html.twig', [
            'discussionThemes' => $discussionThemes
        ]);
    }

    /**
     * Permet d'afficher la page d'un thème
     * 
     *@Route("/theme/{themeSlug}", name="discussion_theme_show")

     * @return Response
     */
    public function show(DiscussionTheme $discussionTheme){

        return $this->render('discussion_theme/discussionThemeShow.html.twig', [
            'discussionTheme' => $discussionTheme
        ]);
    }
    
}
