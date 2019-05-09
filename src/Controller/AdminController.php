<?php

namespace App\Controller;

use App\Entity\Catgorie;
use App\Form\CategorieFormType;
use App\phpClass\Cnavbar;
use App\Repository\AccountRepository;
use App\Repository\ParameterRepository;
use App\Repository\RoleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminController extends AbstractController
{
    private $params;
    public function __construct(ParameterRepository $parameterRepository)
    {
        $this->params['parameter'] = $parameterRepository->find(1);
        $this->params['navbar'] = Cnavbar::getNavbar();
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(ParameterRepository $parameterRepository,RoleRepository $roleRepository, UserInterface $userInterface,AccountRepository $accountRepository)
    {
        $this->params['user'] = $accountRepository->findOneByEmail($userInterface->getUsername());
        $role = $roleRepository->findBySymfonyName($this->params['user']->getRoles()[0]);
        $this->params['userRole'] = $role;
        return $this->render('admin/index.html.twig', $this->params);
    }

    /**
     * @Route("/categorie", name="categorie")
     */
    public function categorie(ObjectManager $manager,Request $request,ParameterRepository $parameterRepository,RoleRepository $roleRepository, UserInterface $userInterface,AccountRepository $accountRepository)
    {
        $this->params['user'] = $accountRepository->findOneByEmail($userInterface->getUsername());
        $role = $roleRepository->findBySymfonyName($this->params['user']->getRoles()[0]);
        $this->params['userRole'] = $role;

        $categorie = new Catgorie();
        $form = $this->createForm(CategorieFormType::class, $categorie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $categorie->setName($form->get('name')->getData());
            $categorie->setColor($form->get('Color')->getData());
            $categorie->setIcon($form->get('Icon')->getData());
            $categorie->setPos($form->get('pos')->getData());
            $manager->persist($categorie);
            $manager->flush();
            return $this->redirectToRoute('categorie');
        }

        $this->params['formCategorie'] = $form->createView();

        return $this->render('admin/categorie.html.twig', $this->params);
    }

    /**
     * @Route("/suject", name="suject")
     */
    public function suject(ParameterRepository $parameterRepository)
    {
        return $this->render('admin/suject.html.twig', $this->params);
    }

    /**
     * @Route("/userAccount", name="userAccount")
     */
    public function userAccount(ParameterRepository $parameterRepository)
    {
        return $this->render('admin/userAccount.html.twig', $this->params);
    }

    /**
     * @Route("/settings", name="settings")
     */
    public function settings(ParameterRepository $parameterRepository)
    {
        return $this->render('admin/settings.html.twig',$this->params);
    }

    /**
     * @Route("/roles", name="roles")
     */
    public function roles(ParameterRepository $parameterRepository)
    {
        return $this->render('admin/roles.html.twig', $this->params);
    }
}
