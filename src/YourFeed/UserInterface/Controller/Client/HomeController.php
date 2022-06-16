<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\UserInterface\Controller\Client;

use Ferdyrurka\YourFeed\Infrastructure\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'client_home', methods: ['GET'])]
    #[Route('/page/{page}', name: 'client_home_page', methods: ['GET'])]
    public function index(PostRepository $postRepository, int $page = 1): Response
    {
        return $this->render(
            'client/home/index.html.twig',
            [
                'posts' => $postRepository->findNewestPosts(page: $page),
            ]
        );
    }
}
