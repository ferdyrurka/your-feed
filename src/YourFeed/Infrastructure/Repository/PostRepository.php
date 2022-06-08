<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ferdyrurka\YourFeed\Domain\Entity\Post;
use Ferdyrurka\YourFeed\Domain\Exception\ObjectNotFoundException;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function get(string $uuid): Post
    {
        $post = $this->findOneBy(['uuid' => $uuid]);

        if (!$post instanceof Post) {
            throw new ObjectNotFoundException();
        }

        return $post;
    }

    public function findOneByExternalId(string $externalId): ?Post
    {
        return $this->findOneBy(['externalId' => $externalId]);
    }

    public function save(Post $post): void
    {
        $this->_em->persist($post);
    }
}
