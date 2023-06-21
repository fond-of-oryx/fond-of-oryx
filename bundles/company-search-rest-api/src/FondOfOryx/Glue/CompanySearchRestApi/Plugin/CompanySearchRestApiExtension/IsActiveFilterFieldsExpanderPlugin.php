<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Plugin\CompanySearchRestApiExtension;

use ArrayObject;
use FondOfOryx\Glue\CompanySearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class IsActiveFilterFieldsExpanderPlugin extends AbstractPlugin implements FilterFieldsExpanderPluginInterface
{
 /**
  * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
  * @param \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
  *
  * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
  */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        $isActive = $restRequest->getHttpRequest()->query->get(
            CompanySearchRestApiConstants::PARAMETER_NAME_IS_ACTIVE,
            'true',
        );

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(CompanySearchRestApiConstants::FILTER_FIELD_TYPE_IS_ACTIVE)
            ->setValue((string)$isActive);

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
