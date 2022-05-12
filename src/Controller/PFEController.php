<?php

namespace App\Controller;

use App\Entity\PFE;
use App\Form\PFEType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PFEController extends AbstractController
{
    #[Route('/pfe/add', name: 'app_pfe')]
    public function addPFE(ManagerRegistry $doctrine,Request $request ): Response
    {
        $entityManager = $doctrine->getManager();

        $pfe = new PFE();
        $form = $this->createForm(PFEType::class, $pfe);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $entityManager->persist($pfe);
            $entityManager->flush();
            return $this->render('pfe.info.html.twig',['pfe' => $pfe]);
        } else {
            return $this->render('pfe.form.html.twig', [
                'form' => $form->createView()
            ]);
        }

    }

    #[Route('pfe/stats', name: 'app_stats')]
    public function index(ManagerRegistry $doctrine,): Response {
        $repo = $doctrine->getRepository(PFE::class);
        $pfesParEntreprise = $repo->nbPFEs();

        return $this->render('pfe.stats.html.twig', [
            'pfesParEntreprise' => $pfesParEntreprise
        ]);
    }

}
