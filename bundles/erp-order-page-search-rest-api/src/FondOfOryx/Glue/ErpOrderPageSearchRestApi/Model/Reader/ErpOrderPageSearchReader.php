<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\ErpOrderPageSearchRestApiConfig;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\ErpOrderMapperInterface;
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
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\ErpOrderMapperInterface
     */
    protected $erpOrderMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface $erpOrderPageSearchClient
     * @param \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface $requestBuilder
     * @param \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\ErpOrderMapperInterface $erpOrderMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface $erpOrderPageSearchClient,
        RequestBuilderInterface $requestBuilder,
        ErpOrderMapperInterface $erpOrderMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->erpOrderPageSearchClient = $erpOrderPageSearchClient;
        $this->requestBuilder = $requestBuilder;
        $this->erpOrderMapper = $erpOrderMapper;
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

        return $this->createResponse($this->erpOrderPageSearchClient->search(
            $requestTransfer->getSearchString(),
            $requestTransfer->getRequestParams()
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

        $collection = $this->erpOrderMapper->mapErpOrderResource($response);
        $resource = $this->restResourceBuilder->createRestResource(
            ErpOrderPageSearchRestApiConfig::RESOURCE_ERP_ORDERS,
            null,
            $collection
        );

        $restResponse->addResource($resource);

        return $restResponse;
    }
}
