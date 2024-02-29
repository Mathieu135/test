<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Contact;
use App\Form\QuestionFormType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact_form')]
    public function contactForm(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(QuestionFormType::class, $contact);
        $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
            // TODO: implementation d'une classe de validation utilisant le component validation pour s'assurer des bonnes information du form. (confirmation d'adresse mail, ect)
            $this->addFlash('success', 'Votre demande de contact a été correctement enregistrée.');

            return $this->redirectToRoute('contact_list');
        }
        // TODO: possibilité de faire un traitement asynchrone qui va créer les fichiers JSON en parallèle pour rendre plus rapidement le rendu au client.
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
