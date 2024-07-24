<?php
declare(strict_types=1);
namespace Pixiekat\AlicantoLearning\Services;

use Doctrine\ORM\EntityManagerInterface;
use Pixiekat\AlicantoLearning\Entity;
use Pixiekat\AlicantoLearning\Entity\Interfaces;
use Psr\Log\LoggerInterface as Logger;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class AlicantoLearningPathManager {

  /**
   * The constructor.
   */
  public function __construct(
    protected EntityManagerInterface $entityManager,
    protected TagAwareCacheInterface $cache,
    protected RequestStack $requestStack,
    protected Logger $logger,
  ) { }

  /**
   * Gets all the learning paths from the database.
   * 
   * @todo allow for filtering by visibility
   */
  public function getCatalog(): array {
    return $this->cache->get('learning_paths__all', function (ItemInterface $item) {
      $this->logger->debug('learning_paths__all cache miss: refreshing');
      $item->expiresAfter(3600);
      $item->tag('learning_path');
      
      $learningPaths = [];
      try {
        $learningPaths = $this->entityManager->getRepository(Entity\LearningPath::class)->findAll();
      }
      catch (\Exception $exception) {
        $item->expiresAt((new \DateTime())->setTimeZone(new \DateTimeZone('America/New_York'))->setTimestamp(strtotime('now')));
      }
      return $learningPaths;
    }, 1.0);
  }

  /**
   * Gets the current timestamp.
   * 
   * @todo once users are in place, this should be replaced with the user's timezone?
   */
  public function getCurrentTimestamp(): ?\DateTimeImmutable {
    $timezone = new \DateTimeZone('UTC');
    return new \DateTimeImmutable('now', $timezone);
  }

  /**
   * Gets the learning path for the current instance of this manager.
   */
  public function getLearningPath(): Interfaces\LearningPathInterface {
    return $this->learningPath;
  }

  /**
   * Sets the learning path for the current instance of this manager.
   */
  public function setLearningPath(Interfaces\LearningPathInterface $learningPath): static {
    $this->learningPath = $learningPath;
    return $this;
  }

}