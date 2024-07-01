<?php

namespace FondOfOryx\Client\EasyApi;

use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\EasyApi\EasyApiFactory getFactory()
 */
class EasyApiClient extends AbstractClient implements EasyApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function findDocument(EasyApiFilterTransfer $filterTransfer): EasyApiResponseTransfer
    {
        return $this->getFactory()->createEasyApiZedStub()->findDocument($filterTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\EasyApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function getDocument(EasyApiRequestTransfer $requestTransfer): EasyApiResponseTransfer
    {
        return $this->getFactory()->createEasyApiZedStub()->getDocument($requestTransfer);
    }
}
