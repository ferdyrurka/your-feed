<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\UserInterface\Controller\Client;

use Ferdyrurka\YourFeed\Domain\Exception\ObjectNotFoundException;
use Ferdyrurka\YourFeed\Infrastructure\Doctrine\Paginator;
use Ferdyrurka\YourFeed\Infrastructure\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private const LIMIT = 20;

    #[Route('/', name: 'client_home', methods: ['GET'])]
    #[Route('/page/{page}', name: 'client_home_page', methods: ['GET'])]
    public function index(PostRepository $postRepository, int $page = 1): Response
    {
        $posts = $postRepository->findNewestPosts(self::LIMIT, $page);

        if (count($posts->getIterator()) === 0) {
            throw new ObjectNotFoundException();
        }

        return $this->render(
            'client/home/index.html.twig',
            [
                'posts' => new Paginator($posts, self::LIMIT, $page),
            ]
        );
    }
}
