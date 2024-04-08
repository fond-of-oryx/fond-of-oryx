<?php

namespace FondOfOryx\Client\ProductPageSearchAttributeExpander\Plugin\SearchExtension;

use Generated\Shared\Transfer\SearchConfigExtensionTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchConfigExpanderPluginInterface;

/**
 * @method \FondOfOryx\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderFactory getFactory()
 */
class SearchConfigExpanderPlugin extends AbstractPlugin implements SearchConfigExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands facet and sort configuration with additional parameters.
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\SearchConfigExtensionTransfer
     */
    public function getSearchConfigExtension(): SearchConfigExtensionTransfer
    {
        return $this->getFactory()
            ->createSearchConfigExtensionBuilder()
            ->build();
    }
}
