<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader;

use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\ErpDeliveryNotePageSearchRestApiConfig;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchCollectionResponseMapperInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator\RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ErpDeliveryNotePageSearchReader implements ErpDeliveryNotePageSearchReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface
     */
    protected $erpDeliveryNotePageSearchClient;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface
     */
    protected $requestBuilder;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchCollectionResponseMapperInterface
     */
    protected $erpDeliveryNoteMapper;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator\RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface
     */
    protected $restErpDeliveryNotePageSearchCollectionResponseTranslator;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface $erpDeliveryNotePageSearchClient
     * @param \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface $requestBuilder
     * @param \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchCollectionResponseMapperInterface $erpDeliveryNoteMapper
     * @param \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator\RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface $restErpDeliveryNotePageSearchCollectionResponseTranslator
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface $erpDeliveryNotePageSearchClient,
        RequestBuilderInterface $requestBuilder,
        RestErpDeliveryNotePageSearchCollectionResponseMapperInterface $erpDeliveryNoteMapper,
        RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface $restErpDeliveryNotePageSearchCollectionResponseTranslator,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->erpDeliveryNotePageSearchClient = $erpDeliveryNotePageSearchClient;
        $this->requestBuilder = $requestBuilder;
        $this->erpDeliveryNoteMapper = $erpDeliveryNoteMapper;
        $this->restErpDeliveryNotePageSearchCollectionResponseTranslator = $restErpDeliveryNotePageSearchCollectionResponseTranslator;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findErpDeliveryNotesByFilterTransfer(RestRequestInterface $restRequest): RestResponseInterface
    {
        $requestTransfer = $this->requestBuilder->create($restRequest);

        $searchResult = $this->erpDeliveryNotePageSearchClient->search(
            $requestTransfer->getSearchString(),
            $requestTransfer->getRequestParams(),
        );

        return $this->createResponse($searchResult, $restRequest->getMetadata()->getLocale());
    }

    /**
     * @param array $searchResult
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createResponse(array $searchResult, string $locale): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $collection = $this->erpDeliveryNoteMapper->fromSearchResult($searchResult);
        $collection = $this->restErpDeliveryNotePageSearchCollectionResponseTranslator->translate(
            $collection,
            $locale,
        );

        $resource = $this->restResourceBuilder->createRestResource(
            ErpDeliveryNotePageSearchRestApiConfig::RESOURCE_ERP_DELIVERY_NOTES,
            null,
            $collection,
        );

        $restResponse->addResource($resource);

        return $restResponse;
    }
}
