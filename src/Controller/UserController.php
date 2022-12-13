<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
#[Route('/myprofile',  name: 'app_profile')]
public function profileShow()
{
    $currentUser=$this->getUser();
    return $this->render('user_profile/index.html.twig', [
        'user'=>$currentUser
    ]);
}

}