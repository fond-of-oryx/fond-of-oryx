<?php

namespace FondOfOryx\Glue\CountriesRestApi\Plugin\GlueApplication;

use FondOfOryx\Glue\CountriesRestApi\CountriesRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipPluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfOryx\Glue\CountriesRestApi\CountriesRestApiFactory getFactory()
 */
class CountriesByCheckoutDataResourceRelationshipPlugin extends AbstractPlugin implements ResourceRelationshipPluginInterface
{
    /**
     * {@inheritDoc}
     * - Adds payment-methods resource as relationship in case RestCheckoutDataTransfer is provided as payload.
     *
     * @api
     *
     * @param array<\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface> $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): void
    {
    }

    /**
     * @return string
     */
    public function getRelationshipResourceType(): string
    {
        return CountriesRestApiConfig::RESOURCE_COUNTRIES;
    }
}
