<?php
declare(strict_types=1);
namespace Pixiekat\AlicantoLearning;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Pixiekat\AlicantoLearning\DependencyInjection\Extension;

class PixiekatAlicantoLearning extends AbstractBundle {
  public function getPath(): string {
      return \dirname(__DIR__);
  }

  public function getContainerExtension(): ?ExtensionInterface {
    return new AlicantoLearningExtension();
  }
}