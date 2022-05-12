<?php

namespace Ferdyrurka\YourFeed\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Ferdyrurka\YourFeed\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('slug')->setFormTypeOption('disabled','disabled'),
        ];
    }
}
