<?php

namespace App\Controller\Admin;

use App\Entity\Rubrik;
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

class RubrikCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rubrik::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(), //Seulement dans la base de donnée
            TextField::new('name')->setColumns('col-md-6'),
            ];
        }
    
        public function configureCrud(Crud $crud): Crud
        {
            return $crud
                ->setEntityLabelInSingular('Rubrik')
                ->setDefaultSort(['id' => 'DESC'])
                ->setPaginatorPageSize(10);
        }
    
        public function configureFilters(Filters $filters): Filters
        {
            return $filters
                ->add('name');
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
