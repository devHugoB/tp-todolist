<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegisterType;
use App\service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route(path: '/', name: 'auth_')]
class SecurityController extends AbstractController
{
    #[Route(path: 'inscription', name: 'register')]
    public function register(Request $request, UserService $userService): Response
    {
        $user = new User();
        $userForm = $this->createForm(UserRegisterType::class, $user);
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $userService->createUser($user);

            return $this->redirectToRoute('auth_login', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('security/register.html.twig', [
            'form' => $userForm->createView()
        ]);
    }

    #[Route(path: 'connexion', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('target_path');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: 'deconnexion', name: 'logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
