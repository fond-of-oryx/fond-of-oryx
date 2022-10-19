<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Expander;

use ArrayObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterFieldsExpander implements FilterFieldsExpanderInterface
{
    /**
     * @var array<\FondOfOryx\Glue\ProductListSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface>
     */
    protected $filterFieldsExpanderPlugins;

    /**
     * @param array<\FondOfOryx\Glue\ProductListSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface> $filterFieldsExpanderPlugins
     */
    public function __construct(array $filterFieldsExpanderPlugins)
    {
        $this->filterFieldsExpanderPlugins = $filterFieldsExpanderPlugins;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        foreach ($this->filterFieldsExpanderPlugins as $filterFieldsExpanderPlugin) {
            $filterFieldsExpanderPlugin->expand($restRequest, $filterFieldTransfers);
        }

        return $filterFieldTransfers;
    }
}
