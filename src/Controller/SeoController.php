<?php

namespace App\Controller;

use App\Entity\Seo;
use App\Form\SeoType;
use App\Repository\SeoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seo")
 */
class SeoController extends AbstractController
{
    /**
     * @Route("/", name="app_seo_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $response = $request->query->get('response');

        if ($response === 'accepted') {
            $seos = $entityManager->getRepository(Seo::class)->findBy(['response' => 'oui']);
        } elseif ($response === 'pending') {
            $seos = $entityManager->getRepository(Seo::class)->findBy(['response' => 'en attente']);
        } else {
            // Si aucun paramètre n'est spécifié, affichez tous les résultats
            $seos = $entityManager
            ->getRepository(Seo::class)
            ->findBy([], ['editDate' => 'DESC']);;
        }
        

        return $this->render('seo/index.html.twig', [
            'seos' => $seos,
        ]);
    }

    

    /**
     * @Route("/new", name="app_seo_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $seo = new Seo();
        $form = $this->createForm(SeoType::class, $seo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $seo->setEditDate(new \DateTime('now'));
            $seo->setAuthor($this->getUser());
            $entityManager->persist($seo);
            $entityManager->flush();

            return $this->redirectToRoute('app_seo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('seo/new.html.twig', [
            'seo' => $seo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_seo_show", methods={"GET"})
     */
    public function show(Seo $Seo): Response
    {
        return $this->render('seo/show.html.twig', [
            'seo' => $Seo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_seo_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Seo $seo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SeoType::class, $seo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $seo->setEditDate(new \DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('app_seo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('seo/edit.html.twig', [
            'seo' => $seo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_seo_delete", methods={"POST"})
     */
    public function delete(Request $request, Seo $Seo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Seo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($Seo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_seo_index', [], Response::HTTP_SEE_OTHER);
    }
}
