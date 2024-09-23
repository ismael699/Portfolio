<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app.home')]
    public function home(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->from($data['email'])
                ->to('ismaelgouasmia@gmail.com')
                ->subject('Message du Portfolio')
                ->text(
                    'Nom :'.$data['name']."\n".
                    'Email :'.$data['email']."\n\n".
                    'Numéro :'.$data['phoneNumber']."\n\n\n".
                    $data['message']
                );

            $mailer->send($email);
            $this->addFlash('success', 'Message envoyé.');

            return $this->redirectToRoute('app.home');
        }

        return $this->render('home/index.html.twig', [
            'contactForm' => $form,
        ]);
    }
}
