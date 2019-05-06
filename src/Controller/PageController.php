<?php

namespace App\Controller;

use App\Entity\Account;
use App\Repository\AccountRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('home.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/validateaccount-{token}", name="validate")
     */
    public function validateAccount(ObjectManager $manager,AccountRepository $accountRepository,$token)
    {

        $user = $accountRepository->findByKeyCreateAccountValidator($token);
        if(count($user) !=0) {
            $user[0]->setIsActive(true);
            $user[0]->setKeyCreateAccountValidator("");
            $manager->persist($user[0]);
            $manager->flush();
            return $this->redirectToRoute('home', ['message' => "Votre compte à été activer"]);
        }
        return $this->redirectToRoute('home', ['message' => "Echec de l'activation de votre compte"]);

    }
}
