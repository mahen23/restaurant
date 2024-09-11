<?php
// src/Controller/PatronController.php

namespace App\Controller;

use App\Entity\Patron;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatronController extends AbstractController
{
    /**
     * @Route("/insert-patron", name="insert_patron")
     */
    public function insertPatron(EntityManagerInterface $entityManager): Response
    {
        $json = file_get_contents('https://dummyjson.com/users');
        $users = json_decode($json, true)['users'];

        return $this->render('patron/insert_patron.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/add-patron", name="add_patron", methods={"POST"})
     */
    public function addPatron(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userId = $request->request->get('user');
        
        $json = file_get_contents('https://dummyjson.com/users');
        $users = json_decode($json, true)['users'];

        foreach ($users as $user) {
            if ($user['id'] == $userId) {
                $patron = new Patron();
                $patron->setName($user['firstName'] . ' ' . $user['lastName']);
                $patron->setEmail($user['email']);
                
                $entityManager->persist($patron);
                $entityManager->flush();
                // Redirect to the success page
                return $this->redirectToRoute('list_patrons');
            }
        }

        return $this->redirectToRoute('insert_patron');
    }

     /**
     * @Route("/list-patrons", name="list_patrons")
     */
    public function listPatrons(EntityManagerInterface $entityManager): Response
    {
        $patrons = $entityManager->getRepository(Patron::class)->findAll();

        return $this->render('patron/list_patrons.html.twig', [
            'patrons' => $patrons,
        ]);
    }
}