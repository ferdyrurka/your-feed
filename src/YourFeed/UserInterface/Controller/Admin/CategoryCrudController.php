<?php

namespace Ferdyrurka\YourFeed\UserInterface\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Ferdyrurka\YourFeed\Domain\Entity\Category;

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
