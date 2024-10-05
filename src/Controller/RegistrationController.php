<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bundle\SecurityBundle\Security\UserAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set the rgpd field to true
            $user->setRgpd(true);

            //Route pour l'avatar
            $avatarFile = $form->get('avatar')->getData();
            if($avatarFile){
                $newFilename = uniqid(). '-'.$avatarFile->getExtension();
                $avatarFile->move(
                    $this->getParameter('kernel.project_dir'). '/public/divers/avatars',
                    $newFilename
                );
                //Mettre à jour l'avatar dans l'entity user
                $user->setAvatar($newFilename);
            }

            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            // Add a flash message
            $this->addFlash('success', 'Votre inscription a bien été enregistrée.');

            // Optionally, you can redirect to a confirmation page or the same page
            return $this->redirectToRoute('app_register');

            return $security->login($user, UserAuthenticator::class, 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
