<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'success' => true,
            'message' => 'Welcome to Path Demo Project!',
        ]);
    }

//    /**
//     * @Route("/hash",name="app_hash")
//     */
//    public function hash(UserPasswordHasherInterface $passwordHasher) {
//        $password = 'j6vmk8y43i7z75bk';
//        $user_id = 1;
//        $user = $this->getDoctrine()->getRepository(User::class)->find($user_id);
//
//        $hashedPassword = $passwordHasher->hashPassword($user,$password);
//
//        dump($hashedPassword);
//        exit;
//    }
}
