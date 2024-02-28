<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Plugin\CompanySearchRestApiExtension;

use ArrayObject;
use FondOfOryx\Glue\CompanySearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractPlugin;
use Throwable;

class CompanyFilterFieldsExpanderPlugin extends AbstractPlugin implements FilterFieldsExpanderPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        $query = $restRequest->getHttpRequest()->query;
        $uuids = [];
        try {
            $uuids[] = $query->get(
                CompanySearchRestApiConstants::PARAMETER_NAME_ID,
            );
        } catch (Throwable $throwable) {
            if ($query->getIterator()->offsetExists(CompanySearchRestApiConstants::PARAMETER_NAME_ID)) {
                $uuids = $query->getIterator()->offsetGet(CompanySearchRestApiConstants::PARAMETER_NAME_ID);
            }
        }

        $count = count($uuids);
        if ($count === 0) {
            return $filterFieldTransfers;
        }

        $type = CompanySearchRestApiConstants::FILTER_FIELD_TYPE_UUIDS;
        if ($count === 1) {
            $type = CompanySearchRestApiConstants::FILTER_FIELD_TYPE_UUID;
        }

        foreach ($uuids as $uuid) {
            $filterFieldTransfer = (new FilterFieldTransfer())
                ->setType($type)
                ->setValue((string)$uuid);

            $filterFieldTransfers->append($filterFieldTransfer);
        }
        return $filterFieldTransfers;
    }
}
