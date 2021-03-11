<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Mapper;

use FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer;

class RestSplittableCheckoutErrorMapper implements RestSplittableCheckoutErrorMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig
     */
    protected $config;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToGlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig $config
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(
        SplittableCheckoutRestApiConfig $config,
        SplittableCheckoutRestApiToGlossaryStorageClientInterface $glossaryStorageClient
    ) {
        $this->config = $config;
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer
     * @param \Generated\Shared\Transfer\RestErrorMessageTransfer $restErrorMessageTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function mapLocalizedRestSplittableCheckoutErrorTransferToRestErrorTransfer(
        RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer,
        RestErrorMessageTransfer $restErrorMessageTransfer,
        string $locale
    ): RestErrorMessageTransfer {
        return $this->mergeErrorDataWithErrorConfiguration(
            $restSplittableCheckoutErrorTransfer,
            $restErrorMessageTransfer,
            $this->translateCheckoutErrorMessage($restSplittableCheckoutErrorTransfer, $locale)->toArray()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Mapper\RestErrorMessageTransfer $restErrorMessageTransfer
     * @param array $errorData
     *
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApi\Mapper\RestErrorMessageTransfer
     */
    protected function mergeErrorDataWithErrorConfiguration(
        RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer,
        RestErrorMessageTransfer $restErrorMessageTransfer,
        array $errorData
    ): RestErrorMessageTransfer {
        $errorIdentifierMapping = $this->getErrorIdentifierMapping($restSplittableCheckoutErrorTransfer);

        if ($errorIdentifierMapping) {
            $errorData = array_merge($errorIdentifierMapping, array_filter($errorData));
        }

        return $restErrorMessageTransfer->fromArray($errorData, true);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCheckoutErrorTransfer $restCheckoutErrorTransfer
     *
     * @return array
     */
    protected function getErrorIdentifierMapping(RestCheckoutErrorTransfer $restCheckoutErrorTransfer): array
    {
        return $this->config->getErrorIdentifierToRestErrorMapping()[$restCheckoutErrorTransfer->getErrorIdentifier()] ?? [];
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer
     */
    protected function translateCheckoutErrorMessage(
        RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer,
        string $locale
    ): RestSplittableCheckoutErrorTransfer {
        if (!$restSplittableCheckoutErrorTransfer->getDetail()) {
            return $restSplittableCheckoutErrorTransfer;
        }

        $restSplittableCheckoutErrorDetail = $this->glossaryStorageClient->translate(
            $restSplittableCheckoutErrorTransfer->getDetail(),
            $locale,
        );

        if (!$restSplittableCheckoutErrorDetail) {
            return $restSplittableCheckoutErrorTransfer;
        }

        return $restSplittableCheckoutErrorTransfer->setDetail($restSplittableCheckoutErrorDetail);
    }
}
