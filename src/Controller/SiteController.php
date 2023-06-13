<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\Seo;
use App\Form\SiteType;
use App\Repository\SiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/site")
 */
class SiteController extends AbstractController
{
    /**
     * @Route("/", name="app_site_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $sites = $entityManager
            ->getRepository(Site::class)
            ->findAll();

        return $this->render('site/index.html.twig', [
            'sites' => $sites,
        ]);
    }

    /**
     * @Route("/new", name="app_site_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $site = new Site();
        $form = $this->createForm(SiteType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $site->setEditDate(new \DateTime('now'));
            $site->setAuthor($this->getUser());
            $entityManager->persist($site);
            $entityManager->flush();
            $this->addFlash("success","site ajouté");
            return $this->redirectToRoute('app_site_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('site/new.html.twig', [
            'site' => $site,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_site_show", methods={"GET"})
     */
    public function show(EntityManagerInterface $entityManage, Site $site): Response
    {
        $seoRepo = $entityManage->getRepository(Seo::class);
        $accpeted = sizeof($seoRepo->findBy(['site' => $site->getId(), 'response' => "oui"]));
        return $this->render('site/show.html.twig', [
            'site' => $site,
            'accepted' => $accpeted,
            'waited' => 3,
            'rejected' => 1
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_site_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Site $site, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SiteType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $site->setEditDate(new \DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('app_site_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('site/edit.html.twig', [
            'site' => $site,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_site_delete", methods={"POST"})
     */
    public function delete(Request $request, Site $site, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$site->getId(), $request->request->get('_token'))) {
            $entityManager->remove($site);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_site_index', [], Response::HTTP_SEE_OTHER);
    }
}
