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

class LearningPathFormType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options): void {

    $builder
      ->add('name', FormTypes\TextType::class, [
        'required' => false,
      ])
      ->add('description', FormTypes\TextareaType::class, [
        'required' => false,
      ])
      ->add('objectives', FormTypes\TextareaType::class, [
        'required' => false,
      ])
      ->add('visibility', FormTypes\ChoiceType::class, [
        'choices' => $this->getVisibilityOptions(),
        'constraints' => [
          new Assert\Choice([
            'choices' => $this->getVisibilityOptions(),
            'message' => 'learning_path.visibility.invalid',
          ]),
        ],
        'required' => true,
      ])
      ->add('courses', CourseCollectionFormType::class, [])
      ->add('submit', FormTypes\SubmitType::class, [
        'attr' => [
          'class' => 'btn-primary',
        ],
      ])
      ->add('cancel', FormTypes\SubmitType::class, [
        'attr' => [
          'class' => 'btn-link',
        ],
      ])
    ;
  }

  public function configureOptions(OptionsResolver $resolver): void {
    $resolver->setDefaults([
      'choices_as_values' => false,
      'data_class' => Entity\LearningPath::class,
    ]);
  }

  protected function getVisibilityOptions(): array {
    return [
      'Public' => (int) Entity\LearningPath::VISIBILITY_PUBLIC,
      'Registered Users' => Entity\LearningPath::VISIBILITY_REGISTERED,
      'Private' => Entity\LearningPath::VISIBILITY_PRIVATE,
    ];
  }
}
