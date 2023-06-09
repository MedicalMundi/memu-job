<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb\Form;

use Publishing\Cms\Application\Model\ConcorsoArticle\ConcorsoArticle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConcorsoArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
//            ->add('publicationStart')
//            ->add('publicationEnd')
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
            ->add('isDraft')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConcorsoArticle::class,
        ]);
    }
}
