<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    private ContactRepository $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    #[Route('/', name: 'app_contact')]
    public function RenderHompeage(): Response
    {
        $contacts = $this->contactRepository->findAll();
      
        return $this->render('contact/homepage.html.twig', [
            'controller_name' => 'ContactController',
            'contacts' => $contacts
        ]);
    }
}
