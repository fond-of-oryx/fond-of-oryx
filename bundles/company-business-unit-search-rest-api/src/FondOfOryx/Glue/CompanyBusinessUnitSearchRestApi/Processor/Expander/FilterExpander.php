<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Expander;

use ArrayObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterExpander implements FilterExpanderInterface
{
    /**
     * @var array<\FondOfOryx\Glue\CompanyBusinessUnitSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface>
     */
    protected $filterFieldsExpanderPlugins;

    /**
     * @param array<\FondOfOryx\Glue\CompanyBusinessUnitSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface> $filterFieldsExpanderPlugins
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
