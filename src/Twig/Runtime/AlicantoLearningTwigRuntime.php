<?php
declare(strict_types=1);
namespace Pixiekat\AlicantoLearning\Twig\Runtime;
use Pixiekat\AlicantoLearning\DependencyInjection\AlicantoLearningExtension;
use Pixiekat\AlicantoLearning\Entity;
use Pixiekat\AlicantoLearning\Services;
use Twig\Extension\RuntimeExtensionInterface;

class AlicantoLearningTwigRuntime implements RuntimeExtensionInterface {
  
  /**
   * The constructor for this runtime.
   */
  public function __construct(
    private Services\AlicantoLearningPathManager $learningPathManager,
  ) { }

  public function getLearningPathManager(): Services\AlicantoLearningPathManager {
    return $this->learningPathManager;
  }
}
