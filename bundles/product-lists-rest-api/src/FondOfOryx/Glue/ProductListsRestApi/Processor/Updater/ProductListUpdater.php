<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Updater;

use FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiClientInterface;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListUpdateRequestMapperInterface;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ProductListUpdater implements ProductListUpdaterInterface
{
    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListUpdateRequestMapperInterface
     */
    protected $restProductListUpdateRequestMapper;

     /**
      * @var \FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiClientInterface
      */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\ProductListsRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListUpdateRequestMapperInterface $restProductListUpdateRequestMapper
     * @param \FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiClientInterface $client
     */
    public function __construct(
        RestResponseBuilderInterface $restResponseBuilder,
        RestProductListUpdateRequestMapperInterface $restProductListUpdateRequestMapper,
        ProductListsRestApiClientInterface $client
    ) {
        $this->restResponseBuilder = $restResponseBuilder;
        $this->restProductListUpdateRequestMapper = $restProductListUpdateRequestMapper;
        $this->client = $client;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestProductListsAttributesTransfer $restProductListsAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function update(
        RestRequestInterface $restRequest,
        RestProductListsAttributesTransfer $restProductListsAttributesTransfer
    ): RestResponseInterface {
        $restProductListUpdateRequestTransfer = $this->restProductListUpdateRequestMapper
            ->fromRestRequest($restRequest)
            ->setProductList($restProductListsAttributesTransfer);

        if ($restProductListUpdateRequestTransfer->getProductListId() === null) {
            return $this->restResponseBuilder->buildProductListIdIsMissingRestResponse();
        }

        $restProductListUpdateResponseTransfer = $this->client->updateProductListByRestProductListUpdateRequest(
            $restProductListUpdateRequestTransfer,
        );

        $productListTransfer = $restProductListUpdateResponseTransfer->getProductList();
        if ($productListTransfer === null || $restProductListUpdateResponseTransfer->getIsSuccessful() === false) {
            return $this->restResponseBuilder->buildErrorRestResponse();
        }

        return $this->restResponseBuilder->buildRestResponse($productListTransfer);
    }
}
