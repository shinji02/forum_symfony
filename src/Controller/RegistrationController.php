<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\RegistrationFormType;
use App\phpClass\Cmail;
use App\Repository\ParameterRepository;
use App\Security\LoginAuthenticator;
use ReCaptcha\ReCaptcha;
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
    public function register(ParameterRepository $parameterRepository,Cmail $cmail,AuthenticationUtils $authenticationUtils,Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginAuthenticator $authenticator, UserPasswordEncoderInterface $encoder): Response
    {

        $errorForm="";
        $sucessForm="";
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $user = new Account();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $parameter = $parameterRepository->find(1);
            $recaptcha = new ReCaptcha($parameter->getGoogleReCaptchaSecretKey());
            $resp = $recaptcha->setScoreThreshold(0.5)
                ->verify($_POST['googleToken']);
            if ($resp->isSuccess()) {
                // Verified!
                if ($form->get('plainPassword')->getData() == $form->get("confirmPassword")->getData()) {
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
                    $sucessForm = "Merci de vérifier vos mail";
                    //$this->redirectToRoute("home");
                } else {
                    $errorForm = "Vos mot de passe ne sont pas identique";
                }
            }
            else
            {
                $errorForm = "Vous etez un robot";
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
            'errorForm' => $errorForm,
            'sucessForm' => $sucessForm,
            'parameter' => $parameterRepository->find(1)
        ]);
    }
}
