<?php

namespace App\Controller;

use App\Entity\Recette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    #[Route('/recette/{id}', name: 'app_recette')]
    public function index(int $id, EntityManagerInterface $em): Response
    {
        $recette = $em->getRepository(Recette::class)->find($id);

        if (!$recette) {
            throw $this->createNotFoundException('Plat non trouvé');
        }

        return $this->render('recette/recette.html.twig', ['recette' => $recette]);
    }
}
