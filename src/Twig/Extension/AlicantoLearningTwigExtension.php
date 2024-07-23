<?php
declare(strict_types=1);
namespace Pixiekat\AlicantoLearning\Twig\Extension;

use Pixiekat\AlicantoLearning\Twig\Runtime\AlicantoLearningTwigRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AlicantoLearningTwigExtension extends AbstractExtension {
  public function getFilters(): array {
    return [
      //new TwigFilter('get_promotion_manager', [PromotionExtensionRuntime::class, 'getPromotionManager']),
    ];
  }

  public function getFunctions(): array {
    return [
      new TwigFunction('get_learning_path_manager', [AlicantoLearningTwigExtension::class, 'getLearningPathManager']),
    ];
  }
}
