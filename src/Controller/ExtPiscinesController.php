<?php

namespace App\Controller;

use App\Entity\Filtrations;
use App\Entity\PiscineColors;
use App\Entity\PiscineEsc;
use App\Entity\PiscineForme;
use App\Entity\PiscineListe;
use App\Entity\PiscineTailles;
use App\Form\ExtPiscineColorsType;
use App\Form\ExtPiscineEscType;
use App\Form\ExtPiscineFormeType;
use App\Form\ExtPiscineTaillesType;
use App\Form\ExtPiscineType;
use App\Form\FiltrationsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExtPiscinesController extends AbstractController
{
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
        $filters = $this->em->getRepository(Filtrations::class)->findAll();

        return $this->render('ext_piscines/index.html.twig', [
            'formes' => $formes,
            'piscines' => $piscines,
            'filters' => $filters
        ]);
    }

    #[Route(path: '/admin/piscines/forme', name: 'app_create_form')]
    public function createForme(Request $request): Response
    {
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
    public function updateForme(Request $request, int $id): Response
    {
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
    public function createPiscine(Request $request): Response
    {
        $piscine = new PiscineListe();
        $form = $this->createForm(ExtPiscineType::class, $piscine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('images_piscines_dir'),
                    $imageName
                );
                $piscine->setImage($imageName);
            }

            $imageFond = $form->get('image_fond')->getData();
            if ($imageFond) {
                $imageName = md5(uniqid()) . '.' . $imageFond->guessExtension();
                $imageFond->move(
                    $this->getParameter('images_piscines_dir'),
                    $imageName
                );
                $piscine->setImageFond($imageName);
            }

            $this->em->persist($piscine);
            $this->em->flush();
        }

        return $this->render('ext_piscines/form-manager.html.twig', [
            'title' => "Créer une piscine",
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/admin/piscines/piscine/{id}', name: 'app_update_piscine')]
    public function updatePiscine(Request $request, int $id): Response
    {
        $piscine = $this->em->getRepository(PiscineListe::class)->find($id);
        $form = $this->createForm(ExtPiscineType::class, $piscine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('images_piscines_dir'),
                    $imageName
                );
                $piscine->setImage($imageName);
            }
            
            $this->em->persist($piscine);
            $this->em->flush();
        }

        return $this->render('ext_piscines/form-manager.html.twig', [
            'title' => "Créer une piscine",
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/piscines/dims/{id}', name: 'app_dims')]
    public function dimensions(Request $request, int $id)
    {
        $piscine = $this->em->getRepository(PiscineListe::class)->find($id);
        $dims = $this->em->getRepository(PiscineTailles::class)->findBy(['piscine' => $piscine]);
        $taille = new PiscineTailles();

        $form = $this->createForm(ExtPiscineTaillesType::class, $taille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('tailles_img_dir'),
                    $imageName
                );
                $taille->setImage($imageName);
            }

            $taille->setPiscine($piscine);
            $this->em->persist($taille);
            $this->em->flush();

            $referer = $request->headers->get('referer');
            $response = new RedirectResponse($referer);

            return $response;
        }

        return $this->render('ext_piscines/dims-manager.html.twig', [
            'title' => "Dimensions de la piscine : " . $piscine->getNom() . " ",
            'poolId' => $piscine->getId(),
            'form' => $form->createView(),
            'dims' => $dims,
        ]);
    }

    #[Route('/admin/piscines/dim-update/{poolid}/{id}', name: 'app_dims_update')]
    public function dimUpdate(Request $request, int $poolid, int $id) 
    {
        $piscine = $this->em->getRepository(PiscineListe::class)->find($poolid);
        $taille = $this->em->getRepository(PiscineTailles::class)->find($id);

        $form = $this->createForm(ExtPiscineTaillesType::class, $taille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('tailles_img_dir'),
                    $imageName
                );
                $taille->setImage($imageName);
            }

            $taille->setPiscine($piscine);
            $this->em->persist($taille);
            $this->em->flush();

            $referer = $request->headers->get('referer');
            $response = new RedirectResponse($referer);

            return $this->redirectToRoute('app_dims', ['id' => $piscine->getId()]);
        }

        return $this->render('ext_piscines/dim-update.html.twig', [
            'title' => "Modifier une taille de piscine",
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/piscines/delete-dim/{id}', name: 'app_dims_delete')]
    public function dimensionDelete(Request $request, int $id)
    {
        $dim = $this->em->getRepository(PiscineTailles::class)->findOneBy(['id' => $id]);

        // Suppression des filtrations
        $filters = $this->em->getRepository(Filtrations::class)->findBy(['tailles' => $id]);
        array_map(function($filter) {
            $this->em->remove($filter);
            $this->em->flush();
        }, $filters);

        $this->em->remove($dim);
        $this->em->flush();

        $route = $request->headers->get('referer');

        return $this->redirect($route);
    }


    #[Route('/admin/piscines/accessoires/{id}', name: 'app_esc_bain')]
    public function escaliers(Request $request, int $id)
    {
        $piscine = $this->em->getRepository(PiscineListe::class)->find($id);
        $escs = $this->em->getRepository(PiscineEsc::class)->findBy(['piscine' => $piscine]);
        $esc = new PiscineEsc();

        $form = $this->createForm(ExtPiscineEscType::class, $esc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $imageName = md5(uniqid()) . '.' . $image->guessExtension();
            $image->move(
                $this->getParameter('images_escs_dir'),
                $imageName
            );
            
            $esc->setPiscine($piscine);
            $esc->setImage($imageName);

            $this->em->persist($esc);
            $this->em->flush();

            return $this->redirectToRoute('app_esc_bain', [
                'id' => $piscine->getId()
            ]);
        }

        return $this->render('ext_piscines/esc-manager.html.twig', [
            'title' => "Accessoires de la piscine : " . $piscine->getNom(),
            'form' => $form->createView(),
            'escs' => $escs,
        ]);
    }

    #[Route('/admin/piscines/colors/{id}', name: 'app_colors')]
    public function colors(Request $request, int $id) 
    {
        $piscine = $this->em->getRepository(PiscineListe::class)->find($id);
        $colors = $this->em->getRepository(PiscineColors::class)->findBy(['piscine' => $piscine]);
        $color = new PiscineColors();

        $form = $this->createForm(ExtPiscineColorsType::class, $color);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $image = $form->get('color')->getData();
            $imageName = md5(uniqid()) . '.' . $image->guessExtension();
            $image->move(
                $this->getParameter('images_colors_dir'),
                $imageName
            );
            
            $color->setPiscine($piscine);
            $color->setColor($imageName);

            $this->em->persist($color);
            $this->em->flush();

            return $this->redirectToRoute('app_colors', [
                'id' => $piscine->getId()
            ]);
        }

        return $this->render('ext_piscines/color-manager.html.twig', [
            'title' => "Couleurs de la piscine : " . $piscine->getNom(),
            'form' => $form->createView(),
            'colors' => $colors,
        ]);
    }

    #[Route('/admin/piscines/delete-color/{id}', name: 'app_color_delete')]
    public function deleteColor(Request $request, int $id)
    {
        $color = $this->em->getRepository(PiscineColors::class)->find($id);

        $this->em->remove($color);
        $this->em->flush();

        $route = $request->headers->get('referer');

        return $this->redirect($route);
    }

    
    #[Route(path: '/admin/piscines/filtrations', name: 'app_create_filter')]
    public function filters(Request $request): Response
    {
        $filter = new Filtrations();
        $form = $this->createForm(FiltrationsType::class, $filter);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion de la piscine
            // $piscine = $this->em->getRepository(PiscineListe::class)->find($form->get('nom')->getData());
            // $filter->setNom($piscine);

            // Gestion de la taille
            $taille = $this->em->getRepository(PiscineTailles::class)->find($form->get('tailles')->getData());
            $filter->setTailles($taille);

            // Gestion de l'image
            $image = $form->get('image')->getData();
            $imageName = md5(uniqid()) . '.' . $image->guessExtension();
            $image->move(
                $this->getParameter('images_filters_dir'),
                $imageName
            );
            $filter->setImage($imageName);

            $this->em->persist($filter);
            $this->em->flush();
        }

        return $this->render('ext_piscines/filter-manager.html.twig', [
            'title' => 'Créer une nouvelle filtration',
            'form' => $form->createView(),
        ]);
    }
}
