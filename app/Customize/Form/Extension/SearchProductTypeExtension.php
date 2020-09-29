<?php

namespace Customize\Form\Extension;

use Eccube\Form\Type\SearchProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchProductTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tag_id', HiddenType::class, []);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return SearchProductType::class;
    }
}
