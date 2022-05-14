<?php

namespace Ferdyrurka\YourFeed\UserInterface\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Ferdyrurka\YourFeed\Domain\Entity\Category;
use Ferdyrurka\YourFeed\Domain\Entity\Post;
use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin_home')]
    public function index(): Response
    {
        return $this->render('admin/dashboard/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Your feed');
    }

    public function configureMenuItems(): iterable
    {
         yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('Categories', 'fa fa-book', Category::class);
         yield MenuItem::linkToCrud('Posts', 'fa fa-signs-post', Post::class);
         yield MenuItem::linkToCrud('Source', 'fa fa-book', Source::class);
    }
}
