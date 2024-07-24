<?php
declare(strict_types=1);
namespace Pixiekat\AlicantoLearning\Entity\Interfaces;

interface LearningPathInterface {
  
  /**
   * The value for public visibility.
   */
  public const VISIBILITY_PUBLIC = 100;

  /**
   * The value for registered user visibility.
   */
  public const VISIBILITY_REGISTERED = 200;

  /**
   * The value for private visibility.
   */
  public const VISIBILITY_PRIVATE = 1000;

  /**
   * An array of the available visibility options.
   */
  public const VISIBILITY_OPTIONS = [
    self::VISIBILITY_PUBLIC => 'Public',
    self::VISIBILITY_REGISTERED => 'Registered Users',
    self::VISIBILITY_PRIVATE => 'Private',
  ];
}