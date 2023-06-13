<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb\Form;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Publishing\Cms\Application\Model\ConcorsoArticle\ConcorsoArticle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConcorsoArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => false,
                'label' => 'Titolo',
            ])
            //->add('content', TextareaType::class, [
            ->add('content', CKEditorType::class, [
                'required' => false,
                'label' => 'Contenuto',
            ])
            ->add('publicationStart', DateType::class, [
                'required' => false,
                'label' => 'Inizio pubblicazione',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'empty_data' => '',
            ])
            ->add('publicationEnd', DateType::class, [
                'required' => false,
                'label' => 'Fine pubblicazione',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'empty_data' => '',
            ])
            ->add('isDraft', CheckboxType::class, [
                'required' => false,
                'label' => 'Bozza',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConcorsoArticle::class,
        ]);
    }
}
