<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\UserInterface\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Ferdyrurka\YourFeed\Domain\Enum\Period;
use Ferdyrurka\YourFeed\Infrastructure\EasyAdmin\EnumField;

class SourceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Source::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            BooleanField::new('searchable'),
            UrlField::new('url'),
            EnumField::new('period')
                ->setClass(Period::class),
            AssociationField::new('category')->autocomplete()
        ];
    }
}
