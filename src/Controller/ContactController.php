<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class ContactController extends AbstractController
{

    private EntityManagerInterface $entityManagerInterface;
    private ContactRepository $contactRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface, ContactRepository $contactRepository)
    {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->contactRepository = $contactRepository;
    }

    #[Route('/', name: 'app_contact')]
    public function RenderHompeage(Request $request, PaginatorInterface $paginator): Response
    {
      
        $query = $this->contactRepository->createQueryBuilder('c')
            ->getQuery();

        $contacts = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), 
            5
        );

        return $this->render('contact/homepage.html.twig', [
            'contacts' => $contacts
        ]);
    }

    #[Route('/new', name: 'app_contact_new')]
    public function renderNewContact(Request $request): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManagerInterface->persist($contact);
            $this->entityManagerInterface->flush();

            $this->addFlash('success', 'Contact created successfully.');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/{name}-{id}', name: 'app_contact_edit')]
    public function renderEditContact(string $name, int $id, Request $request): Response
    {
        $contact = $this->contactRepository->find($id);

        if (!$contact) {
            $this->addFlash('notice', 'Contact not found');
            return $this->redirectToRoute('app_contact');
        }

        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           
            $this->entityManagerInterface->flush();

            $this->addFlash('success', 'Contact updated successfully.');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{identifier}', name: 'app_contact_delete')]
    public function deleteContact(int $identifier): Response
    {
        $contact = $this->contactRepository->find($identifier);

        if (!$contact || !($contact instanceof Contact)) {
            throw $this->createNotFoundException('Contact not found or not an instance of App\Entity\Contact');
        }

        $this->entityManagerInterface->remove($contact);
        $this->entityManagerInterface->flush();

        return $this->redirectToRoute('app_contact');
    }
    
    
}
