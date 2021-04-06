<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiFactory getFactory()
 */
class ReturnLabelsRestApiClient extends AbstractClient implements ReturnLabelsRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer
     */
    public function generateReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ReturnLabelRestApiResponseTransfer {
        return $this->getFactory()
            ->createReturnLabelZedStub()
            ->generateReturnLabel($restReturnLabelRequestTransfer);
    }
}
