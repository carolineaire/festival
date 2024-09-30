<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Rubrik;
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
            ->setTitle('Festival - Administration');
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
            yield MenuItem::section('Posts');
            yield MenuItem::subMenu('Posts', 'fa-sharp fa-solid fa-blog')->setSubItems([
                MenuItem::linkToCrud('Create Post', 'fas fa-newspaper', Post::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Post', 'fas fa-eye', Post::class),
            ]);
        }
        if($this->isGranted('ROLE_MODO')){
            yield MenuItem::section('Comments');
            yield MenuItem::subMenu('Comments', 'fas fa-comment-dots')->setSubItems([
                MenuItem::linkToCrud('Create Comment', 'fas fa-newspaper', Comment::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Comment', 'fas fa-eye', Comment::class),
            ]);
        }

        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Rubrik');
            yield MenuItem::subMenu('Rubrik', 'fa-solid fa-book-open-reader')->setSubItems([
                MenuItem::linkToCrud('Create Rubrik', 'fas fa-newspaper', Rubrik::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Rubrik', 'fas fa-eye', Rubrik::class),
            ]);
        }

        if($this->isGranted('ROLE_SUPER_ADMIN')){
            yield MenuItem::section('User');
            yield MenuItem::subMenu('User', 'fa-user-circle')->setSubItems([
                MenuItem::linkToCrud('Create User', 'fas fa-plus-circle', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show User', 'fas fa-eye', User::class),
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
