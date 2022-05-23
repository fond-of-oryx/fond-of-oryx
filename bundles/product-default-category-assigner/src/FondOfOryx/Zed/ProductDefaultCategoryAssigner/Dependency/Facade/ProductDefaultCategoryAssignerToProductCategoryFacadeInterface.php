<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Dependency\Facade;

interface ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
{
    /**
     * @param int $idCategory
     * @param array<int> $productIdsToAssign
     *
     * @return void
     */
    public function createProductCategoryMappings(int $idCategory, array $productIdsToAssign): void;
}
