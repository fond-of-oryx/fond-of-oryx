<?php

namespace FondOfOryx\Glue\CompanyUserOrderBudgetSearchRestApi\Plugin\OrderBudgetSearchRestApiExtension;

use ArrayObject;
use FondOfOryx\Glue\OrderBudgetSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanyUserOrderBudgetSearchRestApi\CompanyUserOrderBudgetSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class CompanyUserFilterFieldsExpanderPlugin extends AbstractPlugin implements FilterFieldsExpanderPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        if ($restRequest->getResource()->getId() !== null) {
            return $filterFieldTransfers;
        }

        $companyUserReference = $restRequest->getHttpRequest()->query->get(
            CompanyUserOrderBudgetSearchRestApiConstants::PARAMETER_NAME_COMPANY_USER_REFERENCE,
        );

        if ($companyUserReference === null) {
            return $filterFieldTransfers;
        }

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_USER_REFERENCE)
            ->setValue((string)$companyUserReference);

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
