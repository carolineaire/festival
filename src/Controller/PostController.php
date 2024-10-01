<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Rubrik;
use App\Entity\RubrikMed;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\MediaRepository;
use App\Repository\PostRepository;
use App\Repository\ProgRepository;
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
    private $prorepo;

    public function __construct(PostRepository $repo, ProgRepository $prorepo, EntityManagerInterface $emi){
        $this->repo = $repo;
        $this->emi = $emi;
        $this->prorepo = $prorepo;
    }

    #[Route('/', name: 'app_post')] //Page d'accueil
    public function index(): Response
    {
        //Afficher dernier article (article à la une) col-md-7 à gauche
        $posts = $this->repo->findBy([], ['createdAt' => 'DESC'], 1);

        //Afficher 3/4 articles à droite de l'article à la une, col-md-3 à droite
        $posts2 = $this->repo->findBy([], ['createdAt' => 'DESC'], 3, 2);

        //Afficher un résumé de la programmation
        $randomProg = $this->prorepo->findRandomArtists(3);

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
            'posts2' => $posts2,
            'randomProg' => $randomProg
        ]);
    }

    //Gestion de la récuperation des articles par rubrique
    #[Route('/rubrik/{id}', name: 'rubrik')] 
    public function postsByRubrik(Rubrik $rubrik, PostRepository $prepo): Response
    {
        $posts = $prepo->findByRubrik($rubrik);

        return $this->render('rubrik/rubrik.html.twig', [
            'rubrik' => $rubrik,
            'posts' => $posts,
        ]);
    }

    //Gestion de la récuperation des articles par rubrique média
    #[Route('/rubrikMed/{id}', name: 'rubrikMed')] 
    public function postsByRubrikMed(RubrikMed $rubrik, MediaRepository $mrepo): Response
    {
        $posts = $mrepo->findByRubrikMed($rubrik);

        return $this->render('rubrik/rubrik.html.twig', [
            'rubrikMed' => $rubrik,
            'postsMed' => $posts,
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

    //GESTION DE L'AFFICHAGE DE LA PAGE TRAVAUX EN COURS
    #[Route('/wip', name: 'wip')]
    public function wip(): Response
    {
        //Articles 1 article à la une col-md-8 (à gauche col-md-4)
        $postsA = $this->repo->findBy([], ['createdAt' => 'DESC'], 1);

        //Retour à la vue
        return $this->render('singlePages/soon.html.twig', [
            'postA' => $postsA,
        ]);
    }

    //GESTION DE L'AFFICHAGE DE LA PAGE PROGRAMMATION
    #[Route('/programmation', name: 'programmaton')]
    public function prog(): Response
    {
        //Articles 1 article à la une col-md-8 (à gauche col-md-4)
        // $prog = $this->repo->findBy([], ['createdAt' => 'DESC'], 1);

        //Retour à la vue
        return $this->render('singlePages/soon.html.twig', [
            // 'prog' => $prog,
        ]);
    }
}
