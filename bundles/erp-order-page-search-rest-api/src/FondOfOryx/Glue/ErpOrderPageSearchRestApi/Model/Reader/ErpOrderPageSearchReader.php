<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse;
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
     * ErpOrderPageSearchReader constructor.
     *
     * @param  \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface  $erpOrderPageSearchClient
     * @param  \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface  $requestBuilder
     */
    public function __construct(ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface $erpOrderPageSearchClient, RequestBuilderInterface $requestBuilder)
    {
        $this->erpOrderPageSearchClient = $erpOrderPageSearchClient;
        $this->requestBuilder = $requestBuilder;
    }

    /**
     * @param  \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface  $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findErpOrdersByFilterTransfer(RestRequestInterface $restRequest): RestResponseInterface
    {
        $requestTransfer = $this->requestBuilder->create($restRequest);
        return $this->createResponse($this->erpOrderPageSearchClient->search($requestTransfer->getSearchString(), $requestTransfer->toArray()));
    }

    /**
     * @param  array  $response
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createResponse($response): RestResponseInterface
    {
        //ToDo
        return new RestResponse();
    }
}
