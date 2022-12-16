<?php

namespace FondOfOryx\Glue\PayoneRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\PayoneRestApi\PayoneRestApiConfig;
use Generated\Shared\Transfer\RestPayoneCreditCardRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class PayoneCreditCardCheckResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addGet('get', false);

        return $resourceRouteCollection;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return PayoneRestApiConfig::RESOURCE_PAYONE_CREDIT_CARD_CHECK;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return PayoneRestApiConfig::CONTROLLER_PAYONE_CREDIT_CARD_CHECK;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestPayoneCreditCardRequestAttributesTransfer::class;
    }
}
