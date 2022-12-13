<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/{id}', name: 'comment_delete')]
    public function delete(Comment $comment, Request $request, CommentRepository $commentRepository)
    {
        $commentRepository->remove($comment, true);
        return $this->redirectToRoute('app_index');
    }

}