<?php
/**
 * Created by PhpStorm.
 * User: Arisa
 * Date: 21/11/2018
 * Time: 18:46
 */

namespace App\phpClass;

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


    public function __construct(\Swift_Mailer $mailer, Environment $render)
    {
        $this->mailer = $mailer;
        $this->render = $render;
    }

    public function sendMailValidation($email,$name,$token)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('no-reply@forum.org')
            ->setTo($email,$name)
            ->setSubject("Forum")
            ->setBody(
                $this->render->render(
                    'mail/createAccount.mjml.twig',
                    array(
                        'SiteTitle' => 'Forum',
                        'name' => $name,
                        'addess' => "https://forum_symfony.dev/validateaccount-".$token,
                    )
                ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}