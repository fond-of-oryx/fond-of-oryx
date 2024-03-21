<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Plugin\FilterExpander;

use ArrayObject;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class DefaultShippingExpanderPlugin implements FilterFieldsExpanderPluginInterface
{
    /**
     * @var string
     */
    public const FILTER_NAME = 'default-shipping';

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject $filterFieldTransfers
     *
     * @return \ArrayObject
     */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        $defaultShipping = $restRequest->getHttpRequest()->query->get(static::FILTER_NAME);

        if ($defaultShipping === null) {
            return $filterFieldTransfers;
        }

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_DEFAULT_SHIPPING)
            ->setIsBool(true)
            ->setValue($this->getValue($defaultShipping));

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }

    /**
     * @param string $check
     *
     * @return string
     */
    protected function getValue(string $check): string
    {
        if (filter_var($check, FILTER_VALIDATE_BOOLEAN)) {
            return 'true';
        }

        return 'false';
    }
}
