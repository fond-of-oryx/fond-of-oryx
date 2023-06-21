<?php

namespace FondOfOryx\Glue\CompanyTypeProductListSearchRestApi\Plugin\ProductListSearchRestApiExtension;

use ArrayObject;
use FondOfOryx\Glue\ProductListSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanyTypeProductListSearchRestApi\CompanyTypeProductListSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class ForeignCustomerFilterFieldsExpanderPlugin extends AbstractPlugin implements FilterFieldsExpanderPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    public function expand(
        RestRequestInterface $restRequest,
        ArrayObject $filterFieldTransfers
    ): ArrayObject {
        if ($restRequest->getResource()->getId() !== null) {
            return $filterFieldTransfers;
        }

        $foreignCustomerReference = $restRequest->getHttpRequest()->query->get(
            CompanyTypeProductListSearchRestApiConstants::PARAMETER_NAME_CUSTOMER_ID,
        );

        if ($foreignCustomerReference === null) {
            return $filterFieldTransfers;
        }

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(CompanyTypeProductListSearchRestApiConstants::FILTER_FIELD_TYPE_FOREIGN_CUSTOMER_REFERENCE)
            ->setValue($foreignCustomerReference);

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
