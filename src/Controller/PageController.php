<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Parameter;
use App\Entity\Subjec;
use App\Form\SubjectFormType;
use App\Repository\AccountRepository;
use App\Repository\CatgorieRepository;
use App\Repository\ParameterRepository;
use App\Repository\SubjecRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CatgorieRepository $catgorieRepository, ParameterRepository $parameterRepository,AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('home.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'parameter' => $parameterRepository->find(1),
            'categories'=> $catgorieRepository->findBy([],['pos' => 'ASC']),
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

    /**
     * @Route("/cat", name="cat")
     */
    public function cat(ObjectManager $manager,AccountRepository $accountRepository,UserInterface $userInterface, Request $request,CatgorieRepository $catgorieRepository,AuthenticationUtils $authenticationUtils,ParameterRepository $parameterRepository)
    {
        $categorie = $catgorieRepository->find($_GET['id']);

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        $params = [
            'last_username' => $lastUsername,
            'error' => $error,
            'parameter' => $parameterRepository->find(1),
            'categories' => $catgorieRepository->findBy([], ['pos' => 'ASC']),
        ];

        if(isset($_GET['action']) && !empty($_POST))
        {
           $sujec = new Subjec();
           $sujec->setName($_POST['name']);
           $sujec->setBody($_POST['body']);
           $sujec->setCategorie($catgorieRepository->find($_GET['id']));
           $sujec->setCreateAt(new \DateTime());

            $account = $accountRepository->findOneByEmail($userInterface->getUsername());
            $sujec->setAuhor($account);
            $sujec->setNbView(0);
            $sujec->setFileSystem("");
            $manager->persist($sujec);
            $manager->flush();
            return $this->redirectToRoute('cat',['id' => $_GET['id']    ]);
        }


        return $this->render('cat.html.twig',$params);
    }
    /**
     * @Route("/sub", name="sub")
     */
    public function sub(AccountRepository $accountRepository,UserInterface $userInterface, Request $request,SubjecRepository $subjecRepository,AuthenticationUtils $authenticationUtils,ParameterRepository $parameterRepository)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $params = [
            'last_username' => $lastUsername,
            'error' => $error,
            'parameter' => $parameterRepository->find(1),
            'subject' => $subjecRepository->find($_GET['id']),
        ];
        return $this->render('sub.html.twig',$params);

    }
}

