<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\EasyAdmin;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use RuntimeException;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

final class EnumField implements FieldInterface
{
    use FieldTrait;

    public const OPTION_AUTOCOMPLETE = 'autocomplete';

    public const OPTION_CLASS = 'class';

    public static function new(string $propertyName, $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplatePath('easyadmin/crud/field/enum.html.twig')
            ->setFormType(EnumType::class)
            ->addCssClass('field-select')
            ->setDefaultColumns('') // this is set dynamically in the field configurator
            ->setCustomOption(self::OPTION_CLASS, null)
        ;
    }
    public function autocomplete(): self
    {
        $this->setCustomOption(self::OPTION_AUTOCOMPLETE, true);

        return $this;
    }

    public function setClass(string $class): self
    {
        if (!class_exists($class)) {
            throw new RuntimeException(sprintf('%s class doesn\'t exist', $class));
        }

        $this->setFormTypeOption(self::OPTION_CLASS, $class);

        return $this;
    }
}
