<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(), //Seulement dans la base de donnée
            TextField::new('title')->setColumns('col-md-6'),
            TextField::new('abstract')->setColumns('col-md-6'),
            TextEditorField::new('content')->setColumns('col-md-6'),
            $image = ImageField::new('image')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-2'),
            AssociationField::new('rubrik')->setColumns('col-md-4'),
            AssociationField::new('user')->setColumns('col-md-6'),
            DateField::new('createdAt')->onlyOnIndex(),
            $isPublished = BooleanField::new('is_published')->setPermission('ROLE_ADMIN')->setColumns('col-md-1')->setLabel('Publié')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Post')
            ->setDefaultSort(['createdAt' => 'DESC'])
            ->setPaginatorPageSize(5);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('user')
            ->add('title')
            ->add('rubrik')
            ->add('createdAt');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::DELETE, 'ROLE_ADMIN');
    }
}
