<?php

namespace Customize\Repository;

use Eccube\Doctrine\Query\QueryCustomizer;
use Eccube\Repository\QueryKey;
use Doctrine\ORM\QueryBuilder;


class AdminTagIdSearchCustomizer implements QueryCustomizer {

    public function customize(QueryBuilder $builder, $params, $queryKey)
    {
        if (!empty($params['tag_id']) && $params['tag_id']) {
            $builder->innerJoin('p.ProductTag', 'ptag');
            $builder->innerJoin('ptag.Tag', 'tag');
            $builder->andWhere('tag = :tag_id');
            $builder->setParameter('tag_id', $params['tag_id']);
        }
    }

    public function getQueryKey(): string
    {
        return QueryKey::PRODUCT_SEARCH_ADMIN;
    }
}