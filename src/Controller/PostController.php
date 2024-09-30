<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Rubrik;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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
        // $posts = $this->repo->findBy([], ['createdAt' => 'DESC'], 1);

        //Afficher 3/4 articles à droite de l'article à la une, col-md-3 à droite
        // $posts2 = $this->repo->findBy([], ['createdAt' => 'DESC'], 3, 1);

        return $this->render('post/index.html.twig', [
            // 'posts' => $posts,
            // 'posts2' => $posts2,
        ]);
    }

    //Gestion de la récuperation des articles par rubrique
    #[Route('/rubrik/{id}', name: 'rubrik')] //Page d'accueil
    public function postsByRubrik(Rubrik $rubrik, PostRepository $prepo): Response
    {
        // $posts = $prepo->findByRubrik($rubrik);

        return $this->render('rubrik/rubrik.html.twig', [
            // 'rubrik' => $rubrik,
            // 'posts' => $posts,
        ]);
    }

    //Gestion de la récuperation des articles par rubrique
    #[IsGranted('ROLE_USER')]
    #[Route('/post/{id}', name: 'show', requirements:['id' => '\d+'])]
    public function showone(Post $posts, Request $req, $id, PostRepository $reppo, EntityManagerInterface $emi, CommentRepository $crepo): Response
    {
        //Vérification du post
        if(!$posts) {
            return $this->redirectToRoute('app_post');
        }

        $comments = new Comment();
        $posts = $reppo->find($id);

        //Créer le formulaire
        $commentForm = $this->createForm(CommentType::class, $comments);
        $commentForm->handleRequest($req);

        //Traitement du formulaire de commentaire
        if($commentForm->isSubmitted() && $commentForm->isValid()){
            $user = $this->getUser();
            $comments->setUser($user);
            $comments->setPost($posts);
            $comments->setCreatedAt(new \DateTimeImmutable('now'));

            //Persister le commentaire
            $emi->persist($comments);
            $emi->flush();

            //Rediriger pour eviter la resoumission du formulaire (refresh)
            return $this->redirectToRoute('show', ['id' => $id]);
        }

        //récuperation des commentaires pour le post
        $allComments = $crepo->findByPostOrderedByCreatedAtDesc($id);

        //Rendre la ve avec les données appropriées
        return $this->render('show/show.html.twig', [
            'posts' => $posts,
            'comments' => $allComments,
            'comment_form' => $commentForm->createView(),
        ]);
    }
}
