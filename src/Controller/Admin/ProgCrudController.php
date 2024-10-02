<?php

namespace App\Controller\Admin;

use App\Entity\Prog;
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

class ProgCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prog::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(), //Seulement dans la base de donnée
            TextField::new('artist')->setColumns('col-md-6'),
            TextField::new('style')->setColumns('col-md-6'),
            TextEditorField::new('abstract')->setColumns('col-md-12'),
            TextField::new('time')->setColumns('col-md-4'),
            TextField::new('stage')->setColumns('col-md-4'),
            $image = ImageField::new('avatar')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('col-md-4'),
            ];
        }
    
        public function configureCrud(Crud $crud): Crud
        {
            return $crud
                ->setEntityLabelInSingular('Prog')
                ->setDefaultSort(['id' => 'ASC'])
                ->setPaginatorPageSize(10);
        }
    
        public function configureFilters(Filters $filters): Filters
        {
            return $filters
                ->add('artist')
                ->add('stage')
                ->add('style');
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
