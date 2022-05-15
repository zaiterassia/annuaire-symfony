<?php

namespace App\Controller;

use App\Entity\Annuary;
use App\Form\AnnuaryType;
use App\Repository\AnnuaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/annuary")
 */
class AnnuaryController extends AbstractController
{
    /**
     * @Route("/", name="app_annuary_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $annuaires = $entityManager
            ->getRepository(Annuary::class)
            ->findAll();

        return $this->render('annuary/index.html.twig', [
            'annuaires' => $annuaires,
        ]);
    }

    /**
     * @Route("/new", name="app_annuary_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $annuary = new Annuary();
        $form = $this->createForm(AnnuaryType::class, $annuary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annuary->setDateEdit(new \DateTime('now'));
            $annuary->setAuthor($this->getUser());
            $entityManager->persist($annuary);
            $entityManager->flush();

            return $this->redirectToRoute('app_annuary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annuary/new.html.twig', [
            'annuary' => $annuary,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_annuary_show", methods={"GET"})
     */
    public function show(Annuary $annuary): Response
    {
        return $this->render('annuary/show.html.twig', [
            'annuary' => $annuary,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_annuary_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Annuary $annuary, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnnuaryType::class, $annuary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annuary->setDateEdit(new \DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('app_annuary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annuary/edit.html.twig', [
            'annuary' => $annuary,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_annuary_delete", methods={"POST"})
     */
    public function delete(Request $request, Annuary $annuary, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annuary->getId(), $request->request->get('_token'))) {
            $entityManager->remove($annuary);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_annuary_index', [], Response::HTTP_SEE_OTHER);
    }
}
