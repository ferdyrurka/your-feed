<?php

namespace Ferdyrurka\YourFeed\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ferdyrurka\YourFeed\Helper\Slugger;

#[ORM\Entity]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $slug;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        if ($name) {
            $this->slug = Slugger::slug($name);
        }

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
