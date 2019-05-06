<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\RegistrationFormType;
use App\phpClass\Cmail;
use App\Security\LoginAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Cmail $cmail,AuthenticationUtils $authenticationUtils,Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginAuthenticator $authenticator, UserPasswordEncoderInterface $encoder): Response
    {

        $errorForm="";
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $user = new Account();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($form->get('plainPassword')->getData()==$form->get("confirmPassword")->getData()) {
                // encode the plain password
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
                $token = bin2hex(random_bytes(10));
                $user->setCreateAt(new \DateTime());
                $user->setRoles(['ROLE_USER']);
                $user->setIsActive(false);
                $user->setKeyCreateAccountValidator($token);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                // do anything else you need here, like send an email
                $cmail->sendMailValidation($form->get('email')->getData(), $form->get('username')->getData(), $token);
                $this->redirectToRoute("home");
            }
            else {
                $errorForm = "Vos mot de passe ne sont pas identique";
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
            'errorForm' => $errorForm
        ]);
    }
}
