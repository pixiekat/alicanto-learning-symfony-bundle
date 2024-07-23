<?php
declare(strict_types=1);
namespace Pixiekat\AlicantoLearning\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LearningPathController extends AbstractController {

  public function __construct(private EntityManagerInterface $entityManager) {}

  #[Route('/catalog', name: 'alicanto_learning_course_catalog')]
  public function index(): Response {
    return $this->render('@PixiekatLearningConsult/learning_paths/catalog.html.twig', []);
  }
}
