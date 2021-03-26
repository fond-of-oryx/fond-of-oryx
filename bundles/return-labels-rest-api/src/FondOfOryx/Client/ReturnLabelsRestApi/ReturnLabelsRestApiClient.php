<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiAttributesTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;
use Spryker\Client\Kernel\AbstractClient;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

/**
 * @method \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiFactory getFactory()
 */
class ReturnLabelsRestApiClient extends AbstractClient implements ReturnLabelsRestApiClientInterface
{
    /**
     * @param ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return CompanyUnitAddressTransfer|null
     */
    public function findCompanyUnitAddressByUuid(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): ?CompanyUnitAddressTransfer {
        return $this->getFactory()
            ->createReturnLabelZedStub()
            ->findCompanyUnitAddressByUuid($returnLabelsRestApiTransfer);
    }

    /**
     * @param CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return ReturnLabelRestApiResponseTransfer
     */
    public function getReturnLabelAction(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): ReturnLabelRestApiResponseTransfer {
        return $this->getFactory()
            ->createReturnLabelZedStub()
            ->getReturnLabel($companyUnitAddressTransfer);
    }
}
