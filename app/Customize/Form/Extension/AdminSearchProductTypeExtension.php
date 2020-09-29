<?php
namespace Customize\Form\Extension;

use Eccube\Form\Type\Admin\SearchProductType;
use Customize\Form\Master\TagType as MasterTagType;
use Eccube\Repository\TagRepository;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

class AdminSearchProductTypeExtension extends AbstractTypeExtension
{
    /**
     * @var TagRepository
     */
    protected $tagRepository;

    /**
     * SearchProductType constructor.
     *
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tag_id', MasterTagType::class, [
                'label' => 'admin.product.tag',
                'placeholder' => 'common.select__all_products',
                'required' => false,
                'multiple' => false,
                'expanded' => false,
                'choices' => $this->tagRepository->getList()
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return SearchProductType::class;
    }
}