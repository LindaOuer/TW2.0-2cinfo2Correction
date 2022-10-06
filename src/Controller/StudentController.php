<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController {

    
    #[Route("/hello", name:"hello")]
    public function hello($name="Visitor"):Response {
        // traitement
        return new Response("Hello ". $name);
    }

    #[Route("/list", name:"student_list")]
    public function list (ManagerRegistry $doctrine):Response {

        $students = $doctrine->getRepository(Student::class)->findAll();
        return $this->render('student/list.html.twig',[
            'students' => $students
        ]);
    }

    #[Route("/list2", name:"student_list2")]
    public function list2 (StudentRepository $repo):Response {

        $students = $repo->findAll();
        return $this->render('student/list.html.twig',[
            'students' => $students
        ]);
    }
    #[Route('show/{id}', name: 'student_detail')]
    public function show(ManagerRegistry $doctrine, int $id):Response {
        $student = $doctrine->getRepository(Student::class)->find($id);

        return $this->render('student/show.html.twig',[
            'student' => $student
        ]);
    }
    #[Route('show1/{id}', name: 'student_detail1')]
    public function show1(StudentRepository $repo, int $id):Response {
        $student = $repo->find($id);

        return $this->render('student/show.html.twig',[
            'student' => $student
        ]);
    }
    #[Route('show3/{id}', name: 'student_detail3')]
    public function show3(Student $student=null):Response {
        return $this->render('student/show.html.twig',[
            'student' => $student
        ]);
    }

    #[Route('DeleteStudent/{id}', name:'student_delete')]
    public function delete(Student $student, ManagerRegistry $doctrine):Response{

    $EntityManager = $doctrine->getManager();
    $EntityManager->remove($student);
    $EntityManager->flush();

    return new Response('Suppression Etudiant');
    }

    #[Route('/DeleteStudent1/{id}', name:'student_delete1')]
    public function delete1(Student $student, StudentRepository $repo):Response{

    $repo->remove($student, true);

    return new Response('Suppression Etudiant');
    }

    #[Route('/add', name:'student_add')]
    public function add(ManagerRegistry $doctrine):Response{

    $student = new Student();
    $student->setEmail('meriem.hjiri@esprit.tn');

    $entityManger = $doctrine->getManager();
    $entityManger->persist($student);

    $entityManger->flush();

    return $this->redirectToRoute('student_list');
    }
}