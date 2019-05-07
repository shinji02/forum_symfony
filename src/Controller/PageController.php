<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Parameter;
use App\Repository\AccountRepository;
use App\Repository\ParameterRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ParameterRepository $parameterRepository,AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('home.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'parameter' => $parameterRepository->find(1)
        ]);
    }

    /**
     * @Route("/validateaccount-{token}", name="validate")
     */
    public function validateAccount(ParameterRepository $parameterRepository, ObjectManager $manager,AccountRepository $accountRepository,$token)
    {

        $message= [];
        $user = $accountRepository->findByKeyCreateAccountValidator($token);
        if(count($user) !=0) {
            $user[0]->setIsActive(true);
            $user[0]->setKeyCreateAccountValidator("");
            $manager->persist($user[0]);
            $manager->flush();
            $message['status'] =1;
            $message['message']="Vote compte à été activer";
        }
        else
        {
            $message['status'] =-1;
            $message['message']="Echec de l'activation de votre compte!";
        }


        return $this->render('validate.html.twig', [
            'parameter' => $parameterRepository->find(1),
            'message' => $message,
        ]);
    }
}
