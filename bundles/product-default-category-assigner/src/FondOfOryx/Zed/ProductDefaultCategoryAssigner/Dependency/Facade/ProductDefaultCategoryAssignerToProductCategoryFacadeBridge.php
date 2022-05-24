<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Dependency\Facade;

use Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface;

class ProductDefaultCategoryAssignerToProductCategoryFacadeBridge implements ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
{
    /**
     * @var \Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface
     */
    protected $productCategoryFacade;

    /**
     * @param \Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface $productCategoryFacade
     */
    public function __construct(ProductCategoryFacadeInterface $productCategoryFacade)
    {
        $this->productCategoryFacade = $productCategoryFacade;
    }

    /**
     * @param int $idCategory
     * @param array<int> $productIdsToAssign
     *
     * @return void
     */
    public function createProductCategoryMappings(int $idCategory, array $productIdsToAssign): void
    {
        $this->productCategoryFacade->createProductCategoryMappings($idCategory, $productIdsToAssign);
    }
}
