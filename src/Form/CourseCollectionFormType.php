<?php
namespace Pixiekat\AlicantoLearning\Form;

use Pixiekat\AlicantoLearning\Entity;
use Pixiekat\AlicantoLearning\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as FormTypes;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CourseCollectionFormType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options): void {

    $builder
      ->add('course', FormTypes\CollectionType::class, [
        'entry_type' => CourseFormType::class,
        'entry_options' => [
          'label' => false,
        ],
        'allow_add' => true,
        'allow_delete' => true,
        'by_reference' => false,
        'label' => false,
      ])
    ;
  }

  public function configureOptions(OptionsResolver $resolver): void {
    $resolver->setDefaults([
      'choices_as_values' => false,
      'data_class' => null, //Entity\LearningPath::class,
    ]);
  }
}
