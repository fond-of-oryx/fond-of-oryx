<?php

namespace FondOfOryx\Client\EasyApi\Zed;

use FondOfOryx\Client\EasyApi\Dependency\Client\EasyApiToZedRequestClientInterface;
use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;

class EasyApiZedStub implements EasyApiZedStubInterface
{
    /**
     * @var string
     */
    public const URL_FIND_DOCUMENT = '/easy-api/gateway/find-document';

    /**
     * @var string
     */
    public const URL_GET_DOCUMENT = '/easy-api/gateway/get-document';

    /**
     * @var \FondOfOryx\Client\EasyApi\Dependency\Client\EasyApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\EasyApi\Dependency\Client\EasyApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(EasyApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function findDocument(EasyApiFilterTransfer $filterTransfer): EasyApiResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\EasyApiResponseTransfer $easyApiClientResponseTransfer */
        $easyApiClientResponseTransfer = $this->zedRequestClient->call(
            static::URL_FIND_DOCUMENT,
            $filterTransfer,
        );

        return $easyApiClientResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\EasyApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function getDocument(EasyApiRequestTransfer $requestTransfer): EasyApiResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\EasyApiResponseTransfer $easyApiClientResponseTransfer */
        $easyApiClientResponseTransfer = $this->zedRequestClient->call(
            static::URL_GET_DOCUMENT,
            $requestTransfer,
        );

        return $easyApiClientResponseTransfer;
    }
}
