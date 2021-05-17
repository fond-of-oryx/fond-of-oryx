<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiFactory getFactory()
 */
class ReturnLabelsRestApiClient extends AbstractClient implements ReturnLabelsRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelResponseTransfer
     */
    public function generateReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): RestReturnLabelResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestReturnLabelResponseTransfer $restReturnLabelResponseTransfer */
        $restReturnLabelResponseTransfer = $this->getFactory()
            ->createReturnLabelZedStub()
            ->generateReturnLabel($restReturnLabelRequestTransfer);

        return $restReturnLabelResponseTransfer;
    }
}
