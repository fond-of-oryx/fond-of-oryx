<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Builder;

use FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchAttributesMapperInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator\RestOrderBudgetSearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator\RestOrderBudgetSearchAttributesTranslatorInterface
     */
    protected RestOrderBudgetSearchAttributesTranslatorInterface $restOrderBudgetSearchAttributesTranslator;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchAttributesMapperInterface
     */
    protected RestOrderBudgetSearchAttributesMapperInterface $restOrderBudgetSearchAttributesMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected RestResourceBuilderInterface $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator\RestOrderBudgetSearchAttributesTranslatorInterface $restOrderBudgetSearchAttributesTranslator
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchAttributesMapperInterface $restOrderBudgetSearchAttributesMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestOrderBudgetSearchAttributesTranslatorInterface $restOrderBudgetSearchAttributesTranslator,
        RestOrderBudgetSearchAttributesMapperInterface $restOrderBudgetSearchAttributesMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restOrderBudgetSearchAttributesTranslator = $restOrderBudgetSearchAttributesTranslator;
        $this->restOrderBudgetSearchAttributesMapper = $restOrderBudgetSearchAttributesMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildOrderBudgetSearchRestResponse(
        OrderBudgetListTransfer $orderBudgetListTransfer,
        string $locale
    ): RestResponseInterface {
        $restOrderBudgetSearchAttributesTransfer = $this->restOrderBudgetSearchAttributesMapper->fromOrderBudgetList(
            $orderBudgetListTransfer,
        );

        $restOrderBudgetSearchAttributesTransfer = $this->restOrderBudgetSearchAttributesTranslator->translate(
            $restOrderBudgetSearchAttributesTransfer,
            $locale,
        );

        $restResponse = $this->restResourceBuilder->createRestResponse(
            $restOrderBudgetSearchAttributesTransfer->getPagination()->getNumFound(),
        );

        $restResource = $this->restResourceBuilder->createRestResource(
            OrderBudgetSearchRestApiConfig::RESOURCE_ORDER_BUDGET_SEARCH,
            null,
            $restOrderBudgetSearchAttributesTransfer,
        )->setPayload($orderBudgetListTransfer);

        return $restResponse->addResource($restResource);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUseIsNotSpecifiedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(OrderBudgetSearchRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(OrderBudgetSearchRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
