<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\ErpOrderPageSearchRestApiConfig;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchCollectionResponseMapperInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator\RestErpOrderPageSearchCollectionResponseTranslatorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ErpOrderPageSearchReader implements ErpOrderPageSearchReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface
     */
    protected $erpOrderPageSearchClient;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface
     */
    protected $requestBuilder;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchCollectionResponseMapperInterface
     */
    protected $erpOrderMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator\RestErpOrderPageSearchCollectionResponseTranslatorInterface
     */
    protected $restErpOrderPageSearchCollectionResponseTranslator;

    /**
     * @param \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface $erpOrderPageSearchClient
     * @param \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface $requestBuilder
     * @param \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchCollectionResponseMapperInterface $erpOrderMapper
     * @param \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator\RestErpOrderPageSearchCollectionResponseTranslatorInterface $restErpOrderPageSearchCollectionResponseTranslator
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface $erpOrderPageSearchClient,
        RequestBuilderInterface $requestBuilder,
        RestErpOrderPageSearchCollectionResponseMapperInterface $erpOrderMapper,
        RestErpOrderPageSearchCollectionResponseTranslatorInterface $restErpOrderPageSearchCollectionResponseTranslator,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->erpOrderPageSearchClient = $erpOrderPageSearchClient;
        $this->requestBuilder = $requestBuilder;
        $this->erpOrderMapper = $erpOrderMapper;
        $this->restErpOrderPageSearchCollectionResponseTranslator = $restErpOrderPageSearchCollectionResponseTranslator;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findErpOrdersByFilterTransfer(RestRequestInterface $restRequest): RestResponseInterface
    {
        $requestTransfer = $this->requestBuilder->create($restRequest);

        $searchResult = $this->erpOrderPageSearchClient->search(
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

        $collection = $this->erpOrderMapper->fromSearchResult($searchResult);
        $collection = $this->restErpOrderPageSearchCollectionResponseTranslator->translate($collection, $locale);

        $resource = $this->restResourceBuilder->createRestResource(
            ErpOrderPageSearchRestApiConfig::RESOURCE_ERP_ORDERS,
            null,
            $collection,
        );

        $restResponse->addResource($resource);

        return $restResponse;
    }
}
