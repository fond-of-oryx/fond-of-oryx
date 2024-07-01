<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Dependency\Client;

use FondOfOryx\Client\EasyApi\EasyApiClientInterface;
use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;

class DocumentsRestApiToEasyApiBridge implements DocumentsRestApiToEasyApiInterface
{
    /**
     * @var \FondOfOryx\Client\EasyApi\EasyApiClientInterface
     */
    protected EasyApiClientInterface $client;

    /**
     * @param \FondOfOryx\Client\EasyApi\EasyApiClientInterface $client
     */
    public function __construct(EasyApiClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function findDocument(EasyApiFilterTransfer $filterTransfer): EasyApiResponseTransfer
    {
        return $this->client->findDocument($filterTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\EasyApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function getDocument(EasyApiRequestTransfer $requestTransfer): EasyApiResponseTransfer
    {
        return $this->client->getDocument($requestTransfer);
    }
}
