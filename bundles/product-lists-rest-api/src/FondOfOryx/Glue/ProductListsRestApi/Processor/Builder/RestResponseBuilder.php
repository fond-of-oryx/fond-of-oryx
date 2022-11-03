<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Builder;

use FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListResponseAttributesMapperInterface;
use FondOfOryx\Glue\ProductListsRestApi\ProductListsRestApiConfig;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListResponseAttributesMapperInterface
     */
    protected $restProductListsAttributesMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListResponseAttributesMapperInterface $restProductListsAttributesMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestProductListResponseAttributesMapperInterface $restProductListsAttributesMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restProductListsAttributesMapper = $restProductListsAttributesMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRestResponse(ProductListTransfer $productListTransfer): RestResponseInterface
    {
        $restResource = $this->restResourceBuilder->createRestResource(
            ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS,
            $productListTransfer->getUuid(),
            $this->restProductListsAttributesMapper->fromProductList($productListTransfer),
        )->setPayload($productListTransfer);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addResource($restResource);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildErrorRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(ProductListsRestApiConfig::RESPONSE_CODE_PRODUCT_LIST_COULD_NOT_BE_UPDATED)
            ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->setDetail(ProductListsRestApiConfig::RESPONSE_DETAIL_PRODUCT_LIST_COULD_NOT_BE_UPDATED);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildProductListIdIsMissingRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(ProductListsRestApiConfig::RESPONSE_CODE_PRODUCT_LIST_ID_IS_MISSING)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(ProductListsRestApiConfig::RESPONSE_DETAIL_PRODUCT_LIST_ID_IS_MISSING);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
