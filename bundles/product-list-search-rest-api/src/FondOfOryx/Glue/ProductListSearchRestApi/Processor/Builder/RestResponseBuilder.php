<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Builder;

use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchAttributesMapperInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\ProductListSearchRestApiConfig;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchAttributesMapperInterface
     */
    protected $restProductListSearchAttributesMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchAttributesMapperInterface $restProductListSearchAttributesMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestProductListSearchAttributesMapperInterface $restProductListSearchAttributesMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restProductListSearchAttributesMapper = $restProductListSearchAttributesMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildProductListSearchRestResponse(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): RestResponseInterface {
        $restProductListSearchAttributesTransfer = $this
            ->restProductListSearchAttributesMapper->fromProductListCollection($productListCollectionTransfer);

        $restResponse = $this->restResourceBuilder->createRestResponse(
            $restProductListSearchAttributesTransfer->getPagination()->getNumFound(),
        );

        $restResource = $this->restResourceBuilder->createRestResource(
            ProductListSearchRestApiConfig::RESOURCE_PRODUCT_LIST_SEARCH,
            null,
            $restProductListSearchAttributesTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUseIsNotSpecifiedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(ProductListSearchRestApiConfig::RESPONSE_CODE_PRODUCT_LIST_IS_NOT_SPECIFIED)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(ProductListSearchRestApiConfig::ERROR_MESSAGE_PRODUCT_LIST_IS_NOT_SPECIFIED);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
