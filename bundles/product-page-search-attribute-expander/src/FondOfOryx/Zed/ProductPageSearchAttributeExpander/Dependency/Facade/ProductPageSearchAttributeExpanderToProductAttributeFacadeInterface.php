<?php

namespace FondOfOryx\Zed\ProductPageSearchAttributeExpander\Dependency\Facade;

interface ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return array
     */
    public function getProductAbstractAttributeValues(int $idProductAbstract): array;
}
