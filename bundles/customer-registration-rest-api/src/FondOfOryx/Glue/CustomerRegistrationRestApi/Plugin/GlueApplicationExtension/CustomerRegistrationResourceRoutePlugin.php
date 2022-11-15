<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\CustomerRegistrationRestApi\CustomerRegistrationRestApiConfig;
use Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class CustomerRegistrationResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addPost('post', false)
            ->addPatch('patch', false)
            ->addGet('get', false);

        return $resourceRouteCollection;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return CustomerRegistrationRestApiConfig::RESOURCE_CUSTOMER_REGISTRATION;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return CustomerRegistrationRestApiConfig::CONTROLLER_CUSTOMER_REGISTRATION;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestCustomerRegistrationRequestAttributesTransfer::class;
    }
}
