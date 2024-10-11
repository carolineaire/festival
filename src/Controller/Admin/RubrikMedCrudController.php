<?php

namespace App\Controller\Admin;

use App\Entity\RubrikMed;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RubrikMedCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RubrikMed::class;
    }

    //Gestion des champs dans le menu voir et créer/modifier
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(), //Seulement dans la base de donnée
            TextField::new('name')->setColumns('col-md-6'),
            ];
        }
    
        //Gestion de l'ordre d'affichage dans voir, et le nombre de rubriques affichées par page
        public function configureCrud(Crud $crud): Crud
        {
            return $crud
                ->setEntityLabelInSingular('RubrikMed')
                ->setDefaultSort(['id' => 'DESC'])
                ->setPaginatorPageSize(10);
        }
    
        //Gestion des filtres
        public function configureFilters(Filters $filters): Filters
        {
            return $filters
                ->add('name');
        }
    
        //Gestion des actions autorisées    
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
