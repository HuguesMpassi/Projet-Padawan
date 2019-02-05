<?php

namespace App\Controller\Front;

use App\Entity\Participation;
use App\Entity\Project;
use App\Form\ParticipationFormType;
use App\Form\ProjectFormType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    private $projects_repository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projects_repository = $projectRepository;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('front/main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/project/add",name="project_add")
     */
    public function addProject(Request $request) {
        $project = new Project();
        $form = $this->createForm(ProjectFormType::class,$project);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // Associer le projet à l'utilisateur connecté
            $project->setProposePar($this->getUser());
            $em->persist($project);
            $em->flush();
            $this->addFlash('info','Merci ! Votre projet a été proposé au maître Jedi !');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('front/main/add_project.html.twig',[
           'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/projects", name="projects")
     */
    public function projects() {
       $projects= $this->projects_repository->findAll();
       return $this->render('front/main/projects.html.twig',['projects'=>$projects]);
    }

    /**
     * @Route("/project/{id}",name="project_show")
     */
    public function projectShow(Request $request) {
        $project = $this->projects_repository->find($request->get('id'));
        $participation = new Participation();
        $form  = $this->createForm(ParticipationFormType::class,$participation);
        $form->handleRequest($request);
        return $this->render('front/main/project_show.html.twig',
            ['project'=>$project,'form'=>$form->createView()]);
    }


}
