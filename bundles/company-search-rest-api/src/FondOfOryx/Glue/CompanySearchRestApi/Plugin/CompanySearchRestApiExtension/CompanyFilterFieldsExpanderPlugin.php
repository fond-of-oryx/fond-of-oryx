<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Plugin\CompanySearchRestApiExtension;

use ArrayObject;
use Exception;
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
     * @throws \Exception
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        $query = $restRequest->getHttpRequest()->query;
        $uuids = [];
        try {
            $uuid = $query->get(
                CompanySearchRestApiConstants::PARAMETER_NAME_ID,
            );

            if (is_array($uuid)) { /* @phpstan-ignore-line */
                throw new Exception('should not be an array');
            }

            if ($uuid !== null) {
                $uuids[] = $uuid;
            }
        } catch (Throwable $throwable) {
                $uuids = $query->all(CompanySearchRestApiConstants::PARAMETER_NAME_ID);
        }

        $count = count($uuids);
        if ($count === 0) {
            return $filterFieldTransfers;
        }

        foreach ($uuids as $uuid) {
            $filterFieldTransfer = (new FilterFieldTransfer())
                ->setType(CompanySearchRestApiConstants::FILTER_FIELD_TYPE_UUID)
                ->setValue((string)$uuid);

            $filterFieldTransfers->append($filterFieldTransfer);
        }

        return $filterFieldTransfers;
    }
}
