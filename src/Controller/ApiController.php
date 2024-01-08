<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $em;
    private $request;

    function __construct(EntityManagerInterface $em, RequestStack $request)
    {
        $this->em = $em;
        $this->request = $request->getCurrentRequest();
    }

    #[Route('/api/contact-form', name: 'contact_form', methods: ["POST"])]
    public function contactForm(): JsonResponse
    {
        $data = json_decode($this->request->getContent(), true);

        $dataArray = [
            'type' => $data['type'],
            'pool' => $data['pool'],
            'dims' => $data['dims'],
            'proof' => $data['proof'],
            'customProof' => $data['customProof'],
            'personnalisation' => $data['personnalisation'],
            'filtration' => $data['filtration'],
            'revet' => $data['revet'],
            'color' => $data['color'],
            'securite' => $data['securite'],
        ];

        try {
            return $this->json($dataArray, 200);
        } catch (\Throwable $th) {
            return $this->json([
                'Response' => $th,
                "data" => $data
            ], 500);
        }
    }
}
