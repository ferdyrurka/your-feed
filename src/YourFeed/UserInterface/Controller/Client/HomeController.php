<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\UserInterface\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render(
            'client/home/index.html.twig',
        );
    }
}
