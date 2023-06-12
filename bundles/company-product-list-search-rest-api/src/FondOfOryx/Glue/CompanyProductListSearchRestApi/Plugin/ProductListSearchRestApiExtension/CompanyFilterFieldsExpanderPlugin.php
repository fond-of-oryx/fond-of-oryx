<?php

namespace FondOfOryx\Glue\CompanyProductListSearchRestApi\Plugin\ProductListSearchRestApiExtension;

use ArrayObject;
use FondOfOryx\Glue\ProductListSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanyProductListSearchRestApi\CompanyProductListSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CompanyFilterFieldsExpanderPlugin extends AbstractPlugin implements FilterFieldsExpanderPluginInterface
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

        $companyUuid = $restRequest->getHttpRequest()->query->get(
            CompanyProductListSearchRestApiConstants::PARAMETER_NAME_COMPANY_ID,
        );

        if ($companyUuid === null) {
            return $filterFieldTransfers;
        }

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(CompanyProductListSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID)
            ->setValue((string)$companyUuid);

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
