<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer;
use Symfony\Component\HttpFoundation\Response;

class RestErrorMessageMapper implements RestErrorMessageMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToGlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(SplittableCheckoutRestApiToGlossaryStorageClientInterface $glossaryStorageClient)
    {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function fromRestSplittableCheckoutErrorAndLocaleName(
        RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer,
        string $localeName
    ): RestErrorMessageTransfer {
        $detail = $this->glossaryStorageClient->translate(
            $restSplittableCheckoutErrorTransfer->getMessage(),
            $localeName,
            $restSplittableCheckoutErrorTransfer->getParameters(),
        );

        return (new RestErrorMessageTransfer())->setDetail($detail)
            ->setCode((string)$restSplittableCheckoutErrorTransfer->getErrorCode())
            ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
