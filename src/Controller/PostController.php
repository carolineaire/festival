<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    private $repo;
    private $emi;
    public function __constrcut(PostRepository $repo, EntityManagerInterface $emi){
        $this->repo = $repo;
        $this->emi = $emi;
    }

    #[Route('/', name: 'app_post')] //Page d'accueil
    public function index(): Response
    {
        //Afficher dernier article (article à la une) col-md-7 à gauche
        $posts = $this->repo->findBy([], ['createdAt' => 'DESC'], 1);

        //Afficher 3/4 articles à droite de l'article à la une, col-md-3 à droite
        $posts2 = $this->repo->findBy([], ['createdAt' => 'DESC'], 3, 1);

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
            'posts2' => $posts2,
        ]);
    }
}
