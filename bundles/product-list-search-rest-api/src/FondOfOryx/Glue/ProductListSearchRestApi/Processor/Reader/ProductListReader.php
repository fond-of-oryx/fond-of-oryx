<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Reader;

use FondOfOryx\Client\ProductListSearchRestApi\ProductListSearchRestApiClientInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\ProductListCollectionMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ProductListReader implements ProductListReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\ProductListCollectionMapperInterface
     */
    protected $productListCollectionMapper;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\ProductListSearchRestApi\ProductListSearchRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\ProductListCollectionMapperInterface $productListCollectionMapper
     * @param \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\ProductListSearchRestApi\ProductListSearchRestApiClientInterface $client
     */
    public function __construct(
        ProductListCollectionMapperInterface $productListCollectionMapper,
        RestResponseBuilderInterface $restResponseBuilder,
        ProductListSearchRestApiClientInterface $client
    ) {
        $this->productListCollectionMapper = $productListCollectionMapper;
        $this->restResponseBuilder = $restResponseBuilder;
        $this->client = $client;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function find(RestRequestInterface $restRequest): RestResponseInterface
    {
        $productListCollectionTransfer = $this->productListCollectionMapper->fromRestRequest($restRequest);

        return $this->restResponseBuilder->buildProductListSearchRestResponse(
            $this->client->searchProductList($productListCollectionTransfer),
        );
    }
}
