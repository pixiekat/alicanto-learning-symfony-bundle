<?php
declare(strict_types=1);
namespace Pixiekat\AlicantoLearning\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Pixiekat\AlicantoLearning\Entity;
use Pixiekat\AlicantoLearning\Form;
use Pixiekat\AlicantoLearning\Services;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type as FormTypes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LearningPathController extends AbstractController {

  public function __construct(
    private EntityManagerInterface $entityManager,
    private Services\AlicantoLearningPathManager $learningPathManager,
    private TagAwareCacheInterface $cache,
    private TranslatorInterface $translator,
  ) {}

  #[Route('/catalog', name: 'alicanto_learning_course_catalog')]
  public function catalog(): Response {
    $learningPaths = $this->learningPathManager->getCatalog();
    return $this->render('@PixiekatAlicantoLearning/learning_paths/catalog.html.twig', [
      'learning_paths' => $learningPaths,
    ]);
  }

  #[Route('/learning-path/add', name: 'alicanto_learning_learning_path_add')]
  public function add(Request $request): Response {
    $learningPath = new Entity\LearningPath();
    $learningPath->setCreatedAt($this->learningPathManager->getCurrentTimestamp());

    $form = $this->createForm(Form\LearningPathFormType::class, $learningPath);
    $form->handleRequest($request);

    if ($form->has('cancel') && $form->get('cancel')->isClicked()) {
      return $this->redirectToRoute('alicanto_learning_course_catalog');
    }

    if ($form->isSubmitted() && $form->isValid()) {
      $this->entityManager->persist($learningPath);
      $this->entityManager->flush();
      $this->addFlash('success', $this->translator->trans('learning_path.created', ['%name%' => $learningPath->getName()]));
      $this->cache->invalidateTags(['learning_path', "learning_path:{$learningPath->getId()}"]);
      return $this->redirectToRoute('alicanto_learning_course_catalog');
    }
    return $this->render('@PixiekatAlicantoLearning/learning_paths/add.html.twig', [
      'form' => $form->createView(),
      'learning_path' => $learningPath,
    ]);
  }

  #[Route('/learning-path/{id}/delete', name: 'alicanto_learning_learning_path_delete', requirements: ['id' => '\d+'])]
  public function delete(Entity\LearningPath $learningPath, Request $request): Response {
    $form = $this->createFormBuilder()
      ->add('submit', FormTypes\SubmitType::class, [
        'attr' => [
          'class' => 'btn-danger',
        ],
      ])
      ->add('cancel', FormTypes\SubmitType::class, [
        'attr' => [
          'class' => 'btn-link',
        ],
      ])
      ->getForm()
    ;
    $form->handleRequest($request);

    if ($form->has('cancel') && $form->get('cancel')->isClicked()) {
      return $this->redirectToRoute('alicanto_learning_course_catalog');
    }

    if ($form->isSubmitted() && $form->isValid()) {
      $this->entityManager->remove($learningPath);
      $this->entityManager->flush();
      $this->addFlash('success', $this->translator->trans('learning_path.deleted', ['%name%' => $learningPath->getName()]));
      $this->cache->invalidateTags(["learning_path", "learning_path:{$learningPath->getId()}"]);
      return $this->redirectToRoute('alicanto_learning_course_catalog');
    }
    return $this->render('@PixiekatAlicantoLearning/learning_paths/delete.html.twig', [
      'form' => $form->createView(),
      'learning_path' => $learningPath,
    ]);
  }

  #[Route('/learning-path/{id}/edit', name: 'alicanto_learning_learning_path_edit', requirements: ['id' => '\d+'])]
  public function edit(Entity\LearningPath $learningPath, Request $request): Response {
    $form = $this->createForm(Form\LearningPathFormType::class, $learningPath);
    $form->handleRequest($request);

    if ($form->has('cancel') && $form->get('cancel')->isClicked()) {
      return $this->redirectToRoute('alicanto_learning_course_catalog');
    }

    if ($form->isSubmitted() && $form->isValid()) {
      $this->entityManager->persist($learningPath);
      $this->entityManager->flush();
      $this->addFlash('success', $this->translator->trans('learning_path.updated', ['%name%' => $learningPath->getName()]));
      $this->cache->invalidateTags(["learning_path:{$learningPath->getId()}"]);
      return $this->redirectToRoute('alicanto_learning_course_catalog');
    }
    return $this->render('@PixiekatAlicantoLearning/learning_paths/add.html.twig', [
      'form' => $form->createView(),
      'learning_path' => $learningPath,
    ]);
  }

  #[Route('/learning-path/{id}', name: 'alicanto_learning_learning_path_view', requirements: ['id' => '\d+'])]
  public function view(Entity\LearningPath $learningPath, Request $request): Response {
    return $this->render('@PixiekatAlicantoLearning/learning_paths/view.html.twig', [
      'learning_path' => $learningPath,
    ]);
  }
}
