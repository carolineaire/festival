<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnDetail()->setColumns('col-md-4'),
            TextField::new('firstname')->setColumns('col-md-4'),
            TextField::new('lastname')->setColumns('col-md-4'),
            TextField::new('email')->setColumns('col-md-4'),
            TextField::new('username')->setColumns('col-md-4'),
            TextField::new('city')->setColumns('col-md-4'),
            TextField::new('country')->setColumns('col-md-4'),
            TextField::new('phone')->setColumns('col-md-4'),
            TextField::new('opption')->setColumns('col-md-4'),
            TextField::new('password')->setColumns('col-md-4'),
            ImageField::new('avatar')
                ->setUploadDir('public/divers/avatars')
                ->setBasePath('divers/avatars')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-2'),
            DateField::new('createdAt')->onlyOnIndex(),
            $roles = ChoiceField::new('roles')->setColumns('col-md-4')->setChoices([
                'ROLE_USER' => 'ROLE_USER',
                'ROLE_EDITOR' => 'ROLE_EDITOR',
                'ROLE_MODO' => 'ROLE_MODO',
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN'
            ])->allowMultipleChoices(), //Quand on créer notre app on créer le premier user c'est lui qui aura le rôle le plus élevé (super admin)
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('firstname')
            ->add('lastname')
            ->add('city')
            ->add('country')
            ->add('roles');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN');
    }
}
