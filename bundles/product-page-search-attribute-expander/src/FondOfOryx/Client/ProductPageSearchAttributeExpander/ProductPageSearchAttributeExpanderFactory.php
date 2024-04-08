<?php

namespace FondOfOryx\Client\ProductPageSearchAttributeExpander;

use FondOfOryx\Client\ProductPageSearchAttributeExpander\Builder\SearchConfigExtensionBuilder;
use FondOfOryx\Client\ProductPageSearchAttributeExpander\Builder\SearchConfigExtensionBuilderInterface;
use Spryker\Client\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig getConfig()
 */
class ProductPageSearchAttributeExpanderFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ProductPageSearchAttributeExpander\Builder\SearchConfigExtensionBuilderInterface
     */
    public function createSearchConfigExtensionBuilder(): SearchConfigExtensionBuilderInterface
    {
        return new SearchConfigExtensionBuilder($this->getConfig());
    }
}
