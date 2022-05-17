<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\UserInterface\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Ferdyrurka\YourFeed\Domain\Entity\Post;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('slug'),
            UrlField::new('url'),
            TextField::new('checksum'),
            TextEditorField::new('description')->hideOnIndex(),
            DateTimeField::new('publicationDate'),
            DateTimeField::new('updatedAt'),
            DateTimeField::new('createdAt'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return Actions::new()
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_INDEX, Action::DELETE)
            ->add(Crud::PAGE_DETAIL, Action::INDEX)
            ->add(Crud::PAGE_DETAIL, Action::DELETE)
        ;
    }
}
