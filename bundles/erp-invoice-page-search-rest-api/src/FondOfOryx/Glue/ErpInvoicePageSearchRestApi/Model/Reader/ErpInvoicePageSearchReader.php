<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Reader;

use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\ErpInvoicePageSearchRestApiConfig;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchCollectionResponseMapperInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator\RestErpInvoicePageSearchCollectionResponseTranslatorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ErpInvoicePageSearchReader implements ErpInvoicePageSearchReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface
     */
    protected $erpInvoicePageSearchClient;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface
     */
    protected $requestBuilder;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchCollectionResponseMapperInterface
     */
    protected $restErpInvoicePageSearchCollectionResponseMapper;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator\RestErpInvoicePageSearchCollectionResponseTranslatorInterface
     */
    protected $restErpInvoicePageSearchCollectionResponseTranslator;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface $erpInvoicePageSearchClient
     * @param \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface $requestBuilder
     * @param \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchCollectionResponseMapperInterface $restErpInvoicePageSearchCollectionResponseMapper
     * @param \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator\RestErpInvoicePageSearchCollectionResponseTranslatorInterface $restErpInvoicePageSearchCollectionResponseTranslator
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface $erpInvoicePageSearchClient,
        RequestBuilderInterface $requestBuilder,
        RestErpInvoicePageSearchCollectionResponseMapperInterface $restErpInvoicePageSearchCollectionResponseMapper,
        RestErpInvoicePageSearchCollectionResponseTranslatorInterface $restErpInvoicePageSearchCollectionResponseTranslator,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->erpInvoicePageSearchClient = $erpInvoicePageSearchClient;
        $this->requestBuilder = $requestBuilder;
        $this->restErpInvoicePageSearchCollectionResponseMapper = $restErpInvoicePageSearchCollectionResponseMapper;
        $this->restErpInvoicePageSearchCollectionResponseTranslator = $restErpInvoicePageSearchCollectionResponseTranslator;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findErpInvoicesByFilterTransfer(RestRequestInterface $restRequest): RestResponseInterface
    {
        $requestTransfer = $this->requestBuilder->create($restRequest);

        $searchResult = $this->erpInvoicePageSearchClient->search(
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

        $collection = $this->restErpInvoicePageSearchCollectionResponseMapper->fromSearchResult($searchResult);
        $collection = $this->restErpInvoicePageSearchCollectionResponseTranslator->translate($collection, $locale);

        $resource = $this->restResourceBuilder->createRestResource(
            ErpInvoicePageSearchRestApiConfig::RESOURCE_ERP_INVOICES,
            null,
            $collection,
        );

        $restResponse->addResource($resource);

        return $restResponse;
    }
}
