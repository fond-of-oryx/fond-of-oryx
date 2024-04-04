<?php

namespace FondOfOryx\Zed\ProductPageSearchAttributeExpander\Dependency\Facade;

use Spryker\Zed\ProductAttribute\Business\ProductAttributeFacadeInterface;

class ProductPageSearchAttributeExpanderToProductAttributeFacadeBridge implements ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface
{
    /**
     * @var \Spryker\Zed\ProductAttribute\Business\ProductAttributeFacadeInterface
     */
    protected $productAttributeFacade;

    /**
     * @param \Spryker\Zed\ProductAttribute\Business\ProductAttributeFacadeInterface $productAttributeFacade
     */
    public function __construct(ProductAttributeFacadeInterface $productAttributeFacade)
    {
        $this->productAttributeFacade = $productAttributeFacade;
    }

    /**
     * @param int $idProductAbstract
     *
     * @return array
     */
    public function getProductAbstractAttributeValues(int $idProductAbstract): array
    {
        return $this->productAttributeFacade->getProductAbstractAttributeValues($idProductAbstract);
    }
}
