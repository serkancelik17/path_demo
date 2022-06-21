<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="app_index")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/IndexController.php',
        ]);
    }

    /**
     * @Route("/hash",name="app_hash")
     */
    public function hash(UserPasswordHasherInterface $passwordHasher) {
        $password = 'j6vmk8y43i7z75bk';
        $user_id = 1;
        $user = $this->getDoctrine()->getRepository(User::class)->find($user_id);

        $hashedPassword = $passwordHasher->hashPassword($user,$password);

        dump($hashedPassword);
        exit;
    }
}
