<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Builder;

use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchAttributesMapperInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Translator\RestCartSearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\QuoteListTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Translator\RestCartSearchAttributesTranslatorInterface
     */
    protected $restCartSearchAttributesTranslator;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchAttributesMapperInterface
     */
    protected $restCartSearchAttributesMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Translator\RestCartSearchAttributesTranslatorInterface $restCartSearchAttributesTranslator
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchAttributesMapperInterface $restCartSearchAttributesMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestCartSearchAttributesTranslatorInterface $restCartSearchAttributesTranslator,
        RestCartSearchAttributesMapperInterface $restCartSearchAttributesMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restCartSearchAttributesTranslator = $restCartSearchAttributesTranslator;
        $this->restCartSearchAttributesMapper = $restCartSearchAttributesMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCartSearchRestResponse(
        QuoteListTransfer $quoteListTransfer,
        string $locale
    ): RestResponseInterface {
        $restCartSearchAttributesTransfer = $this->restCartSearchAttributesMapper->fromQuoteList(
            $quoteListTransfer,
        );

        $restCartSearchAttributesTransfer = $this->restCartSearchAttributesTranslator->translate(
            $restCartSearchAttributesTransfer,
            $locale,
        );

        $restResponse = $this->restResourceBuilder->createRestResponse(
            $restCartSearchAttributesTransfer->getPagination()->getNumFound(),
        );

        $restResource = $this->restResourceBuilder->createRestResource(
            CartSearchRestApiConfig::RESOURCE_CART_SEARCH,
            null,
            $restCartSearchAttributesTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUseIsNotSpecifiedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CartSearchRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(CartSearchRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
