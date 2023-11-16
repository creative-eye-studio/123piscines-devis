<?php

namespace App\Controller;

use App\Entity\PiscineForme;
use App\Entity\PiscineListe;
use App\Entity\PiscineTailles;
use App\Form\ExtPiscineFormeType;
use App\Form\ExtPiscineTaillesType;
use App\Form\ExtPiscineType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExtPiscinesController extends AbstractController
{
    private $request;
    private $em;

    function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/admin/piscines', name: 'app_piscines')]
    public function index(): Response
    {
        $formes = $this->em->getRepository(PiscineForme::class)->findAll();
        $piscines = $this->em->getRepository(PiscineListe::class)->findAll();

        return $this->render('ext_piscines/index.html.twig', [
            'formes' => $formes,
            'piscines' => $piscines 
        ]);
    }

    #[Route(path: '/admin/piscines/forme', name: 'app_create_form')]
    public function createForme(Request $request): Response {
        $forme = new PiscineForme();
        $form = $this->createForm(ExtPiscineFormeType::class, $forme);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $image = $form->get('image')->getData();
            if ($image != null) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('images_formes_dir'),
                    $imageName
                );
            } else {
                $imageName = "no_image.jpg";
            }
            $forme->setImage($imageName);

            $this->em->persist($forme);
            $this->em->flush();
        }

        return $this->render('ext_piscines/form-manager.html.twig', [
            'title' => 'Créer une nouvelle forme de piscine',
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/admin/piscines/forme/{id}', name: 'app_update_form')]
    public function updateForme(Request $request, int $id): Response {
        $forme = $this->em->getRepository(PiscineForme::class)->find($id);
        $form = $this->createForm(ExtPiscineFormeType::class, $forme);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $image = $form->get('image')->getData();
            if ($image != null) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('images_formes_dir'),
                    $imageName
                );
            } else {
                $imageName = $forme->getImage();
            }
            $forme->setImage($imageName);

            $this->em->persist($forme);
            $this->em->flush();
        }

        return $this->render('ext_piscines/form-manager.html.twig', [
            'title' => "Modifier la forme : " . $forme->getNom(),
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/admin/piscines/piscine', name: 'app_create_piscine')]
    public function createPiscine(Request $request): Response {
        $piscine = new PiscineListe();
        $form = $this->createForm(ExtPiscineType::class, $piscine);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $this->em->persist($piscine);
            $this->em->flush();
        }

        return $this->render('ext_piscines/form-manager.html.twig', [
            'title' => "Créer une piscine",
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/admin/piscines/piscine/{id}', name: 'app_update_piscine')]
    public function updatePiscine(Request $request, int $id): Response {
        $piscine = $this->em->getRepository(PiscineListe::class)->find($id);
        $form = $this->createForm(ExtPiscineType::class, $piscine);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $this->em->persist($piscine);
            $this->em->flush();
        }

        return $this->render('ext_piscines/form-manager.html.twig', [
            'title' => "Créer une piscine",
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/piscines/dims/{id}', name: 'app_dims')]
    public function dimensions(Request $request, int $id) {
        $piscine = $this->em->getRepository(PiscineListe::class)->find($id);
        $dims = $this->em->getRepository(PiscineTailles::class)->findBy(['piscine' => $piscine]);
        $taille = new PiscineTailles();
    
        $form = $this->createForm(ExtPiscineTaillesType::class, $taille);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $taille->setPiscine($piscine);
            $this->em->persist($taille);
            $this->em->flush();

            $referer = $request->headers->get('referer');
            $response = new RedirectResponse($referer);

            return $response;
        }
    
        return $this->render('ext_piscines/dims-manager.html.twig', [
            'title' => "Dimensions de la piscine : " . $piscine->getNom() . " ",
            'form' => $form->createView(),
            'dims' => $dims,
        ]);
    }    
}
