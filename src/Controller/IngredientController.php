<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(IngredientRepository $respository, PaginatorInterface $paginator, Request $request): Response
    {

        $ingredients = $respository->findAll();

        $ingredients = $paginator->paginate(
            $respository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        
        return $this->render('pages/ingredient/index.html.twig', [
            //'ingredients' va être = au nom qu'on va mettre dans la boucle
            'ingredients' => $ingredients
        ]);
    }

    #[Route('/ingredient/new', name: 'ingredient.new')]
    // On rajoute $request pour l'injection de dépendance quand on ajoute $form->handleRequest($request)
    public function new(Request $request, EntityManagerInterface $manager) :response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);

        //handleRequest pour traiter l'envoi du form
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
           $ingredient = $form->getData();

            $manager->persist($ingredient);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre ingrédient à été crée avec succès !'
            );

            // $this->redirectToRoute('app_ingredient'); //a corriger

        }

        return $this->render('pages/ingredient/new.html.twig', [
            'form' => $form->CreateView()
        ]);
    }

}
