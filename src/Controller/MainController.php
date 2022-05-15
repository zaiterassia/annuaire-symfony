<?php

namespace App\Controller;

use App\Entity\Annuary;
use App\Entity\Seo;
use App\Entity\Site;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main")
     */
    public function index(EntityManagerInterface $entityManage): Response
    {
        $sites = $entityManage->getRepository(Site::class)->findAll();
        $totalSites = $entityManage->getRepository(Site::class)->findAllCount();
        $totalAnnuaries = $entityManage->getRepository(Annuary::class)->findAllCount();
        $totalSeos = $entityManage->getRepository(Seo::class)->findAllCount();
        $totalAcceptedSeo = $entityManage->getRepository(Seo::class)->findCountByResponse("oui");
        $totalWaitedSeo = $entityManage->getRepository(Seo::class)->findCountByResponse("en attente");
        $totalUpdatedAnnuaries = $entityManage->getRepository(Seo::class)->findCountApdated();
        $totalUsers = $entityManage->getRepository(User::class)->findAllCount();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'sites' => $sites,
            'totalSites' => $totalSites,
            'totalAnnuaries' => $totalAnnuaries,
            'totalSeos' => $totalSeos,
            'accepted' => $totalAcceptedSeo,
            'waited' => $totalWaitedSeo,
            'updated' => $totalUpdatedAnnuaries,
            'totalUsers' => $totalUsers,

        ]);
    }
}
