<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder;

use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class SplittableCheckoutRestResponseBuilder implements SplittableCheckoutRestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface
     */
    protected $restSplittableCheckoutMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var array<\FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\RestSplittableCheckoutExpanderPluginInterface>
     */
    protected $restSplittableCheckoutExpanderPlugins;

    /**
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface $restSplittableCheckoutMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param array<\FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\RestSplittableCheckoutExpanderPluginInterface> $restSplittableCheckoutExpanderPlugins
     */
    public function __construct(
        RestSplittableCheckoutMapperInterface $restSplittableCheckoutMapper,
        RestResourceBuilderInterface $restResourceBuilder,
        array $restSplittableCheckoutExpanderPlugins = []
    ) {
        $this->restSplittableCheckoutMapper = $restSplittableCheckoutMapper;
        $this->restResourceBuilder = $restResourceBuilder;
        $this->restSplittableCheckoutExpanderPlugins = $restSplittableCheckoutExpanderPlugins;
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createNotPlacedErrorRestResponse(): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(SplittableCheckoutRestApiConfig::RESPONSE_CODE_SPLITTABLE_CHECKOUT_NOT_PLACED)
            ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->setDetail(SplittableCheckoutRestApiConfig::EXCEPTION_MESSAGE_SPLITTABLE_CHECKOUT_NOT_PLACED);

        return $this->restResourceBuilder->createRestResponse()->addError($restErrorTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutTransfer $splittableCheckoutTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createRestResponse(SplittableCheckoutTransfer $splittableCheckoutTransfer): RestResponseInterface
    {
        $restSplittableCheckoutTransfer = $this->restSplittableCheckoutMapper
            ->fromSplittableCheckout($splittableCheckoutTransfer);

        foreach ($this->restSplittableCheckoutExpanderPlugins as $restSplittableCheckoutExpanderPlugin) {
            $restSplittableCheckoutTransfer = $restSplittableCheckoutExpanderPlugin->expand(
                $splittableCheckoutTransfer,
                $restSplittableCheckoutTransfer,
            );
        }

        $restResource = $this->restResourceBuilder->createRestResource(
            SplittableCheckoutRestApiConfig::RESOURCE_SPLITTABLE_CHECKOUT,
            null,
            $restSplittableCheckoutTransfer,
        );

        $restResource->setPayload($restSplittableCheckoutTransfer);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addResource($restResource)
            ->setStatus(Response::HTTP_CREATED);
    }
}
