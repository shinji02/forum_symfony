<?php
/**
 * Created by PhpStorm.
 * User: Arisa
 * Date: 21/11/2018
 * Time: 18:46
 */

namespace App\phpClass;

use App\Entity\Parameter;
use App\Entity\SocialNetwork;
use App\Repository\ParameterRepository;
use App\Repository\SocialNetworkRepository;
use Swift_Mailer;
use Swift_SmtpTransport;
use Twig\Environment;

class Cmail
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $render;
    /**
    * @var Parameter $parameter
    */
    private $parameter;
    /**
     * @var SocialNetwork $social
     */
    private $social;

    public function __construct(Environment $render,ParameterRepository $parameterRepository,SocialNetworkRepository $socialNetworkRepository)
    {
        $this->parameter = $parameterRepository->find(1);
        $transporter = new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
        $transporter->setUsername($this->parameter->getAccountMailer());
        $transporter->setPassword($this->parameter->getAccountMailerPassword());

        $this->mailer = new Swift_Mailer($transporter);
        $this->render = $render;
        $this->social = $socialNetworkRepository->find(1);
    }

    public function sendMailValidation($email,$name,$token)
    {
        if( isset($_SERVER['HTTPS'] ) )
            $prifix = "https";
        else
            $prifix = "http";

        $message = (new \Swift_Message('['.$this->parameter->getSiteName().'] Confirmez la création de votre compte'))
            ->setFrom('no-reply@'.$this->parameter->getUrlDns(),$this->parameter->getSiteName())
            ->setTo($email,$name)
            ->setSubject("[".$this->parameter->getSiteName()."] Confirmez la créationde votre compte")
            ->setBody(
                $this->render->render(
                    'mail/createAccount.mjml.twig',
                    array(
                        'SiteName' => $this->parameter->getSiteName(),
                        'name' => $name,
                        'addr' => $prifix."://".$this->parameter->getUrlDns()."/validateaccount-".$token,
                        'social' => $this->social,
                    )
                ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}