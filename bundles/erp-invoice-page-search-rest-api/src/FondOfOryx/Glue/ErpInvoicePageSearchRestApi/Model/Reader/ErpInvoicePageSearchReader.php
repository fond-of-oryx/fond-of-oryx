<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Reader;

use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\ErpInvoicePageSearchRestApiConfig;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\ErpInvoiceMapperInterface;
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
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\ErpInvoiceMapperInterface
     */
    protected $erpInvoiceMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface $erpInvoicePageSearchClient
     * @param \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface $requestBuilder
     * @param \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\ErpInvoiceMapperInterface $erpInvoiceMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface $erpInvoicePageSearchClient,
        RequestBuilderInterface $requestBuilder,
        ErpInvoiceMapperInterface $erpInvoiceMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->erpInvoicePageSearchClient = $erpInvoicePageSearchClient;
        $this->requestBuilder = $requestBuilder;
        $this->erpInvoiceMapper = $erpInvoiceMapper;
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

        return $this->createResponse($this->erpInvoicePageSearchClient->search(
            $requestTransfer->getSearchString(),
            $requestTransfer->getRequestParams(),
        ));
    }

    /**
     * @param array $response
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createResponse(array $response): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $collection = $this->erpInvoiceMapper->mapErpInvoiceResource($response);
        $resource = $this->restResourceBuilder->createRestResource(
            ErpInvoicePageSearchRestApiConfig::RESOURCE_ERP_INVOICES,
            null,
            $collection,
        );

        $restResponse->addResource($resource);

        return $restResponse;
    }
}
