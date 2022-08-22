<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder;

use ArrayObject;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestErrorMessageMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Response;

class SplittableCheckoutRestResponseBuilder implements SplittableCheckoutRestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface
     */
    protected $restSplittableCheckoutMapper;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestErrorMessageMapperInterface
     */
    protected $restErrorMessageMapper;

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
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestErrorMessageMapperInterface $restErrorMessageMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param array<\FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\RestSplittableCheckoutExpanderPluginInterface> $restSplittableCheckoutExpanderPlugins
     */
    public function __construct(
        RestSplittableCheckoutMapperInterface $restSplittableCheckoutMapper,
        RestErrorMessageMapperInterface $restErrorMessageMapper,
        RestResourceBuilderInterface $restResourceBuilder,
        array $restSplittableCheckoutExpanderPlugins = []
    ) {
        $this->restSplittableCheckoutMapper = $restSplittableCheckoutMapper;
        $this->restErrorMessageMapper = $restErrorMessageMapper;
        $this->restResourceBuilder = $restResourceBuilder;
        $this->restSplittableCheckoutExpanderPlugins = $restSplittableCheckoutExpanderPlugins;
    }

    /**
     * @param \ArrayObject<int, \Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer> $restSplittableCheckoutErrorTransfers
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createNotPlacedErrorRestResponse(
        ArrayObject $restSplittableCheckoutErrorTransfers,
        RestRequestInterface $restRequest
    ): RestResponseInterface {
        $localeName = $restRequest->getMetadata()->getLocale();
        $restResponse = $this->restResourceBuilder->createRestResponse();

        foreach ($restSplittableCheckoutErrorTransfers as $restSplittableCheckoutErrorTransfer) {
            $restErrorMessageTransfer = $this->restErrorMessageMapper->fromRestSplittableCheckoutErrorAndLocaleName(
                $restSplittableCheckoutErrorTransfer,
                $localeName,
            );

            $restResponse->addError($restErrorMessageTransfer);
        }

        return $restResponse;
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
