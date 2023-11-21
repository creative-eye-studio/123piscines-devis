<?php

namespace App\Controller;

use App\Services\PagesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebPagesIndexController extends AbstractController
{
    private $pages_services;
    private $request;

    public function __construct(PagesService $pages_services)
    {
        $this->pages_services = $pages_services;
        $this->request = new Request();
    }
    
    // Index Page
    // -------------------------------------------------------------------------------------------
    #[Route('/', name: 'web_index')]
    public function index(): Response
    {
        // return $this->pages_services->getMainPage($this->request);
        return $this->render('web_pages_views/aquaestimate.html.twig');
    }

    // Other Page
    // -------------------------------------------------------------------------------------------
    // #[Route('/{_locale}/{page_slug}', name: 'web_page', requirements: ['_locale' => 'fr|en'])]
    // public function page(string $page_slug): Response
    // {
    //     return $this->pages_services->getPage($this->request, $page_slug);
    // }
    
    // Post Page
    // -------------------------------------------------------------------------------------------
    // #[Route('/{_locale}/blog/{post_slug}', name: 'web_post', requirements: ['_locale' => 'fr|en'])]
    // public function post(string $post_slug): Response
    // {
    //     return $this->pages_services->getPost($this->request, $post_slug);
    // }

    // Redirections
    // -------------------------------------------------------------------------------------------
}
