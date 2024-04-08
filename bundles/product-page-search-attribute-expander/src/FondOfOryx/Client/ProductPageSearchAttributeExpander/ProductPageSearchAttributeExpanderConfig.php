<?php

namespace FondOfOryx\Client\ProductPageSearchAttributeExpander;

use FondOfOryx\Shared\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConstants;
use Spryker\Client\Kernel\AbstractBundleConfig;

class ProductPageSearchAttributeExpanderConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getSortableIntegerAttributes(): array
    {
        return $this->get(
            ProductPageSearchAttributeExpanderConstants::SORTABLE_INTEGER_ATTRIBUTES,
            ProductPageSearchAttributeExpanderConstants::DEFAULT_SORTABLE_INTEGER_ATTRIBUTES,
        );
    }

    /**
     * @return array
     */
    public function getSortableStringAttributes(): array
    {
        return $this->get(
            ProductPageSearchAttributeExpanderConstants::SORTABLE_STRING_ATTRIBUTES,
            ProductPageSearchAttributeExpanderConstants::DEFAULT_SORTABLE_STRING_ATTRIBUTES,
        );
    }
}
