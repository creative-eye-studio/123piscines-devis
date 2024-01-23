<?php

namespace App\Controller;

use App\Entity\Filtrations;
use App\Entity\PiscineColors;
use App\Entity\PiscineEsc;
use App\Entity\PiscineForme;
use App\Entity\PiscineListe;
use App\Entity\PiscineTailles;
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

    #[Route('/api/pools', name: 'pool_type')]
    public function poolType(): JsonResponse
    {
        $pools = $this->em->getRepository(PiscineListe::class)->findAll();

        $list = array_map(function($pool) {
            return [
                'id' => $pool->getId(),
                'nom' => $pool->getNom(),
                'image' => $pool->getImage(),
                'fond' => $pool->getImageFond(),
                'prix' => $pool->getPrix(),
            ];
        }, $pools);

        return $this->json($list, 200);
    }

    #[Route(path: '/api/pool-size/{poolId}', name: 'pool_size')]
    public function poolSize(int $poolId): JsonResponse
    {
        $pool = $this->em->getRepository(PiscineListe::class)->find($poolId);
        $sizes = $this->em->getRepository(PiscineTailles::class)->findBy(['piscine' => $pool]);

        $list = array_map(function($size) {
            return [
                'id' => $size->getId(),
                'taille' => $size->getTaille(),
                'prix' => $size->getPrix(),
                'image' => $size->getImage(),
                'alarme' => $size->isSecuAlarme(),
                'cover' => $size->isSecuCover(),
                'barrier' => $size->isSecuBarrier(),
                'alarme_prix' => $size->getSecuAlarmePrix(),
                'cover_prix' => $size->getSecuCoverPrix(),
                'barrier_prix' => $size->getSecuBarrierPrix(),
            ];
        }, $sizes);

        return $this->json($list, 200);
    }

    #[Route('/api/pool-size/{poolId}/data', name: 'pool_data')]
    public function poolSizeData(int $poolId): JsonResponse
    {
        $pool = $this->em->getRepository(PiscineListe::class)->find($poolId);
        $size = $this->em->getRepository(PiscineTailles::class)->findOneBy(['taille' => $pool]);
        $data =  [
            'alarme' => $size->isSecuAlarme(),
            'alarme_prix' => $size->getSecuAlarmePrix(),
            'cover' => $size->isSecuCover(),
            'cover_prix' => $size->getSecuCoverPrix(),
            'barrier' => $size->isSecuBarrier(),
            'barrier_prix' => $size->getSecuBarrierPrix(),
        ];

        return $this->json($data, 200);
    }

    #[Route(path: '/api/pool-esc/{poolId}', name: 'pool_esc')]
    public function poolEsc(int $poolId): JsonResponse
    {
        $pool = $this->em->getRepository(PiscineTailles::class)->find($poolId);
        $sizes = $this->em->getRepository(PiscineEsc::class)->findBy(['taille' => $pool]);

        $list = array_map(function($size) {
            return [
                'id' => $size->getId(),
                'nom' => $size->getNom(),
                'type' => $size->getType(),
                'image' => $size->getImage(),
                'prix' => $size->getPrix(),
            ];
        }, $sizes);

        return $this->json($list, 200);
    }

    #[Route(path: '/api/pool-colors/{poolId}', name: 'pool_colors')]
    public function poolColor(int $poolId): JsonResponse
    {
        $pool = $this->em->getRepository(PiscineListe::class)->find($poolId);
        $sizes = $this->em->getRepository(PiscineColors::class)->findBy(['piscine' => $pool]);

        $list = array_map(function($size) {
            return [
                'id' => $size->getId(),
                'nom' => $size->getTitle(),
                'image' => $size->getColor(),
            ];
        }, $sizes);

        return $this->json($list, 200);
    }

    #[Route(path: '/api/pool-filters/{poolId}/{size}', name: 'pool_filters')]
    public function poolFilters(int $poolId, int $size): JsonResponse
    {
        $pool = $this->em->getRepository(PiscineListe::class)->find($poolId);
        $size = $this->em->getRepository(PiscineTailles::class)->find($size);
        $filters = $this->em->getRepository(Filtrations::class)->findBy([
            'nom' => $pool,
            'tailles' => $size
        ]);

        $list = array_map(function($filter) {
            return [
                'id' => $filter->getId(),
                'type' => $filter->getType(),
                'prix' => $filter->getPrix(),
                'image' => $filter->getImage(),
            ];
        }, $filters);

        return $this->json($list, 200);
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
