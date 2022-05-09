<?php

namespace App\Controller\Admin;

use App\Entity\Visite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VisiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Visite::class;
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
