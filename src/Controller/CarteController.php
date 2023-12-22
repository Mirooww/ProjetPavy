<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Recette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[Route('/categorie', name: 'app_carte')]
    public function index( string $categorie = null, EntityManagerInterface $em ): Response
    {
        $categories = $em -> getRepository(Categorie::class)->findAll();
        if ($categorie && $categorie != 'Tout'){
            $recettes = $em -> getRepository(Recette::class)->findByCategorie($categorie);
        } else {
            $recettes = $em -> getRepository(Recette::class)->findAll();
        }
        return $this->render('carte/Carte.html.twig', [
            'categories' => $categories,
            'recettes' => $recettes,
            'controller_name' => 'CarteController']);
    }
}