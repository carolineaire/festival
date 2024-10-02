<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\Help;
use App\Entity\Media;
use App\Entity\Post;
use App\Entity\Prog;
use App\Entity\Rubrik;
use App\Entity\RubrikMed;
use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();
        //Définir le rôle minimum à avoir pour acceder au dashboard
        if($this->isGranted('ROLE_EDITOR')){
            return $this->render('admin/dashboard.html.twig');
        }else{
            return $this->redirectToRoute('app_post');
        }
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Festival La Paviotek - Administration');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        
        yield MenuItem::linkToRoute('Go To Site', 'fa-solid fa-arrow-rotate-left', 'app_post');

        //Pour définir le rôle du super admin
        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home')->setPermission('ROLE_SUPER_ADMIN');
        }

        if($this->isGranted('ROLE_EDITOR')){
            yield MenuItem::section('Les articles');
            yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
                MenuItem::linkToCrud('Créer un article', 'fa-solid fa-pen', Post::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir mes articles', 'fas fa-eye', Post::class),
                // Si super-admin peut voir tous les articles, sinon peut voir seulement ses articles
            ]);
            yield MenuItem::section('Les médias');
            yield MenuItem::subMenu('Médias', 'fa-solid fa-photo-film')->setSubItems([
                MenuItem::linkToCrud('Créer un média', 'fa-solid fa-pen', Media::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir mes médias', 'fas fa-eye', Media::class),
                // Si super-admin peut voir tous les articles, sinon peut voir seulement ses articles
            ]);
        }

        if($this->isGranted('ROLE_MODO')){
            yield MenuItem::section('Les commentaires');
            yield MenuItem::subMenu('Commentaires', 'fas fa-comment-dots')->setSubItems([
                // MenuItem::linkToCrud('Créer un commentaire', 'fas fa-newspaper', Comment::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir les commentaires', 'fas fa-eye', Comment::class),
            ]);
            yield MenuItem::section('Formulaire de contact');
            yield MenuItem::subMenu('Messages', 'fa-solid fa-inbox')->setSubItems([
                // MenuItem::linkToCrud('Créer un message', 'fas fa-newspaper', Contact::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir les messages', 'fas fa-eye', Contact::class),
            ]);
            yield MenuItem::section('Formulaire de bénévolat');
            yield MenuItem::subMenu('Inscription au bénévolat', 'fa-solid fa-hands')->setSubItems([
                // MenuItem::linkToCrud('Créer une inscription au bénévolat', 'fas fa-newspaper', Help::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir les demandes de bénévolat', 'fas fa-eye', Help::class),
            ]);
        }

        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Rubriques des articles');
            yield MenuItem::subMenu('Rubriques articles', 'fas fa-newspaper')->setSubItems([
                MenuItem::linkToCrud('Créer une rubrique', 'fa-solid fa-pen', Rubrik::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir les rubriques', 'fas fa-eye', Rubrik::class),
            ]);
            yield MenuItem::section('Rubriques des médias');
            yield MenuItem::subMenu('Rubriques médias', 'fa-solid fa-photo-film')->setSubItems([
                MenuItem::linkToCrud('Créer une rubrique', 'fa-solid fa-pen', RubrikMed::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir les rubriques', 'fas fa-eye', RubrikMed::class),
            ]);
            yield MenuItem::section('La programmation');
            yield MenuItem::subMenu('Progammation', 'fa-solid fa-book-open-reader')->setSubItems([
                MenuItem::linkToCrud('Ajouter un artiste', 'fa-solid fa-pen', Prog::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir les artistes', 'fas fa-eye', Prog::class),
            ]);
        }

        if($this->isGranted('ROLE_SUPER_ADMIN')){
            yield MenuItem::section('Les utilisateurs');
            yield MenuItem::subMenu('Utilisateurs', 'fa-solid fa-user')->setSubItems([
                MenuItem::linkToCrud('Créer un utilisateur', 'fa-solid fa-pen', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir les utilisateurs', 'fas fa-eye', User::class),
            ]);
        }
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        if(!$user instanceof User){
            throw new \Exception('Wrong user');
        }
        $avatar = 'divers/avatar' . $user->getAvatar();

        return parent::configureUserMenu($user)
            ->setAvatarUrl($avatar);
    }

}
