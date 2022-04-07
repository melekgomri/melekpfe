<?php

namespace App\Controller\Admin;

use App\Entity\Newsletters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NewslettersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Newsletters::class;
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
