<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    #[Route('/teacher', name: 'app_teacher')]
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => '2CINFO2',
        ]);
    }
    #[Route('/show/{name}', name:'show_teacher')]
    public function showTeacher($name): Response {

        $classes = ['2CINFO2', '2CINFO1', '2cinfo3'];
        return $this->render(
            'teacher/show.html.twig',
            [
                'name' => $name,
                'classes' => $classes,
            ]
        );
    }
    #[Route('/redirect', name:'redirect')]
    public function redirection ():Response {
        return $this->redirectToRoute('hello');
    }
}
