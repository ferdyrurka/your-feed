<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\UserInterface\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('post/{slug}', name: 'client_post', methods: ['GET'])]
    public function index(string $slug): Response
    {
        return new Response();
    }
}
