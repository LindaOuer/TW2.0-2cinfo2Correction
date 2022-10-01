<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route("/listClass", name:"classroom_list")]
    public function list2 (ClassroomRepository $repo):Response {

        $classrooms = $repo->findAll();
        return $this->render('classroom/list.html.twig',[
            'classrooms' => $classrooms
        ]);
    }

    #[Route('showClass/{id}', name: 'classroom_detail')]
    public function show3(Classroom $classroom=null):Response {
        return $this->render('classroom/show.html.twig',[
            'classroom' => $classroom
        ]);
    }
}
