<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\Help;
use App\Entity\Post;
use App\Entity\Media;
use App\Entity\Prog;
use App\Entity\Rubrik;
use App\Entity\RubrikMed;
use App\Entity\User;
use App\Form\CommentType;
use App\Form\ContactType;
use App\Form\HelpType;
use App\Repository\CommentRepository;
use App\Repository\ContactRepository;
use App\Repository\HelpRepository;
use App\Repository\MediaRepository;
use App\Repository\PostRepository;
use App\Repository\ProgRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PostController extends AbstractController
{
    private $repo;
    private $emi;
    private $prorepo;
    private $usrepo;

    public function __construct(PostRepository $repo, ProgRepository $prorepo, UserRepository $usrepo, EntityManagerInterface $emi){
        $this->repo = $repo;
        $this->emi = $emi;
        $this->prorepo = $prorepo;
        $this->usrepo = $usrepo;
    }

    //GESTION DE L'AFFICHE DE LA PAGE D'ACCUEIL INDEX.HTML.TWIG
    #[Route('/', name: 'app_post')] 
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

    //GESTION DE LA RECUPERATION DES ARTICLES PAR RUBRIQUE RUBRIK.HTML.TWIG
    #[Route('/rubrik-post/{id}', name: 'rubrik')] 
    public function postsByRubrik(Rubrik $rubrik, PostRepository $prepo): Response
    {
        $posts = $prepo->findByRubrik($rubrik);

        return $this->render('rubrik/rubrik.html.twig', [
            'rubrik' => $rubrik,
            'posts' => $posts,
        ]);
    }

    //DESTION DE LA RECUPERATION DES MEDIAS PAR RUBRIQUE RUBRIKMED.HTML.TWIG
    #[Route('/rubrik-media/{id}', name: 'rubrikMed')] 
    public function postsByRubrikMed(RubrikMed $rubrik, MediaRepository $mrepo): Response
    {
        $posts = $mrepo->findByRubrikMed($rubrik);

        return $this->render('rubrik/rubrikMed.html.twig', [
            'rubrikMed' => $rubrik,
            'postsMed' => $posts,
        ]);
    }

    //GESTION DE LA RECUPERATION DES DONNEES PERSONNELLES DE L'UTILISATEUR USER.HTML.TWIG
    #[Route('/profil/{id}', name: 'user_profile', requirements:['id' => '\d+'])]
    public function userProfil(User $user, $id, UserRepository $usrepo, EntityManagerInterface $emi): Response
    {
        //Vérification du post
        if(!$user) {
            return $this->redirectToRoute('app_post');
        }

        $user = $usrepo->find($id);
        $age = $this->calculateAge($user->getDate());

        return $this->render('singlePages/user.html.twig', [
            'user' => $user,
            'age' => $age,
        ]);
    }

    //FONCTION POUR CALCULER L'AGE DE L'UTILISATEUR
    private function calculateAge(\DateTimeInterface $dateOfBirth): int
    {
        $today = new \DateTime();
        $age = $today->diff($dateOfBirth)->y;

        return $age;
    }

    //GESTION DE LA RECUPERATION DES ARICLES PAR ID SHOW.HTML.TWIG
    #[IsGranted('ROLE_USER')]
    #[Route('/post/{id}', name: 'show', requirements:['id' => '\d+'])]
    public function show(Post $posts, Request $req, $id, PostRepository $reppo, EntityManagerInterface $emi, CommentRepository $crepo): Response
    {
        //Vérification du post
        if(!$posts) {
            return $this->redirectToRoute('app_post');
        }

        $comments = new Comment();
        $posts = $reppo->find($id);

        //Créer le formulaire de commentaire
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

            //Rediriger pour eviter la resoumission du formulaire
            return $this->redirectToRoute('show', ['id' => $id]);
        }

        //récuperation des commentaires pour le post
        $allComments = $crepo->findByPostOrderedByCreatedAtDesc($id);

        //Rendre la vue avec les données appropriées
        return $this->render('show/show.html.twig', [
            'posts' => $posts,
            'comments' => $allComments,
            'comment_form' => $commentForm->createView(),
        ]);
    }

    //GESTION DE LA RECUPERATION DES MEDIAS PAR ID SHOWMED.HTML.TWIG
    #[IsGranted('ROLE_USER')]
    #[Route('/media/{id}', name: 'showMed', requirements:['id' => '\d+'])]
    public function showMed(Media $media, Request $req, $id, MediaRepository $reppo, EntityManagerInterface $emi, CommentRepository $crepo): Response
    {
        //Vérification du post
        if(!$media) {
            return $this->redirectToRoute('app_post');
        }

        $comments = new Comment();
        $media = $reppo->find($id);

        //Créer le formulaire de commentaire
        $commentForm = $this->createForm(CommentType::class, $comments);
        $commentForm->handleRequest($req);

        //Traitement du formulaire de commentaire
        if($commentForm->isSubmitted() && $commentForm->isValid()){
            $user = $this->getUser();
            $comments->setUser($user);
            $comments->setMedia($media);
            $comments->setCreatedAt(new \DateTimeImmutable('now'));

            //Persister le commentaire
            $emi->persist($comments);
            $emi->flush();

            //Rediriger pour eviter la resoumission du formulaire
            return $this->redirectToRoute('showMed', ['id' => $id]);
        }

        //récuperation des commentaires pour le post
        $allComments = $crepo->findBy(['media' => $media], ['createdAt' => 'DESC']);

        //Rendre la ve avec les données appropriées
        return $this->render('show/showMed.html.twig', [
            'posts' => $media,
            'comments' => $allComments,
            'comment_form' => $commentForm->createView(),
        ]);
    }

    //GESTION DE L'AFFICHAGE DE LA PAGE DE PROGRAMMATION PROG.HTML.TWIG
    #[Route('/programmation', name: 'programmation')] 
    public function programmation(ProgRepository $prorepo): Response
    {
        //Afficher les artistes du vendredi
        $prog = $prorepo->findBy([], ['id' => 'ASC'], 5);

        //Afficher les artistes du samedi
        $prog2 = $prorepo->findBy([], ['id' => 'ASC'], 5, 5);

        //Afficher les artistes du dimanche
        $prog3 = $prorepo->findBy([], ['id' => 'ASC'], 5, 10);

        return $this->render('singlePages/prog.html.twig', [
            'prog' => $prog,
            'prog2' => $prog2,
            'prog3' => $prog3
        ]);
    }

    //GESTION DE L'AFFICHAGE DE LA PAGE DE FORMULAIRE D'INSCRIPTION AU BENEVOLAT HELP.HTML.TWIG
    #[Route('/inscription-benevolat', name: 'help')] 
    public function help(Request $request, HelpRepository $helpRepository, EntityManagerInterface $emi): Response
    {
        $help = new Help();
        $form = $this->createForm(HelpType::class, $help);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Perister et sauvgarder le formulaire
            $emi->persist($help);
            $emi->flush();

             // Ajouter un message pour confirmer l'envoie
             $this->addFlash('success', 'Votre candidature a bien été envoyée.');

            return $this->redirectToRoute('help');
        }

        return $this->render('singlePages/helpers.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    //GESTION DE L'AFFICHAGE DE LA PAGE DU FORMULAIRE DE CONTACT CONTACT.HTML.TWIG
    #[Route('/contact', name: 'contact')] 
    public function contact(Request $request, ContactRepository $contactRepository, EntityManagerInterface $emi): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persiter et sauvegarder le formulaire
            $emi->persist($contact);
            $emi->flush();

            // Ajouter un message pour confirmer l'envoie
            $this->addFlash('success', 'Votre message a bien été envoyé.');

            return $this->redirectToRoute('contact');
        }

        return $this->render('singlePages/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    //GESTION DE L'AFFICHAGE DE LA PAGE DE POLITIQUE DE CONFIDENTIALITE
    #[Route('/politique-de-confidentialité', name: 'privacy')]
    public function privacyPolicy(): Response
    {
        //Articles 1 article à la une col-md-8 (à gauche col-md-4)
        // $postsA = $this->repo->findBy([], ['createdAt' => 'DESC'], 1);

        //Retour à la vue
        return $this->render('rgpd/privacyPolicy.html.twig', [
            // 'postA' => $postsA,
        ]);
    }

    //GESTION DE L'AFFICHAGE DE LA PAGE DES MENTIONS LEGALES
    #[Route('/mentions-legales', name: 'legal')]
    public function legal(): Response
    {
        //Articles 1 article à la une col-md-8 (à gauche col-md-4)
        // $postsA = $this->repo->findBy([], ['createdAt' => 'DESC'], 1);

        //Retour à la vue
        return $this->render('rgpd/legalNotice.html.twig', [
            // 'postA' => $postsA,
        ]);
    }

    //GESTION DE L'AFFICHAGE DE LA PAGE TRAVAUX EN COURS
    #[Route('/wip', name: 'wip')]
    public function wip(): Response
    {
        //Articles 1 article à la une col-md-8 (à gauche col-md-4)
        // $postsA = $this->repo->findBy([], ['createdAt' => 'DESC'], 1);
    
        //Retour à la vue
        return $this->render('singlePages/soon.html.twig', [
            // 'postA' => $postsA,
        ]);
    }

}
