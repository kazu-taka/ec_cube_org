<?php

namespace Customize\Form\Master;

use Doctrine\ORM\EntityRepository;
use Eccube\Form\Type\MasterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => 'Eccube\Entity\Tag',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('t')
                    ->orderBy('t.sort_no', 'DESC');
            }
        ]);
    }

    public function getParent()
    {
        return MasterType::class;
    }

    public function getBlockPrefix()
    {
        return 'tag';
    }
}