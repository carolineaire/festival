<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MediaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Media::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(), //Seulement dans la base de donnée
            TextField::new('title')->setColumns('col-md-12'),
            TextEditorField::new('abstract')->setColumns('col-md-12'),
            $image = ImageField::new('image1')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-3'),
            $image = ImageField::new('image2')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-3'),
            $image = ImageField::new('image3')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-3'),
            $image = ImageField::new('image4')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-3'),
            $image = ImageField::new('image5')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-3'),
            $image = ImageField::new('image6')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-3'),
            $image = ImageField::new('image7')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-3'),
            $image = ImageField::new('image8')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-3'),
            $image = ImageField::new('image9')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-3'),
            $image = ImageField::new('image10')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-3'),
            ];
        }
    
        public function configureCrud(Crud $crud): Crud
        {
            return $crud
                ->setEntityLabelInSingular('Media')
                ->setDefaultSort(['id' => 'DESC'])
                ->setPaginatorPageSize(10);
        }
    
        public function configureFilters(Filters $filters): Filters
        {
            return $filters
                ->add('title')
                ->add('rubrikMed');
        }
    
        public function configureActions(Actions $actions): Actions
        {
            return $actions
                ->setPermission(Action::DELETE, 'ROLE_ADMIN');
        }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
