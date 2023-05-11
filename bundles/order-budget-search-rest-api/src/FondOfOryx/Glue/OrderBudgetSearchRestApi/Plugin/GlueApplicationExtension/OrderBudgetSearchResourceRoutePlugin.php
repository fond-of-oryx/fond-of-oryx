<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig;
use Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class OrderBudgetSearchResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        return $resourceRouteCollection->addGet('get');
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return OrderBudgetSearchRestApiConfig::RESOURCE_ORDER_BUDGET_SEARCH;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return OrderBudgetSearchRestApiConfig::CONTROLLER_RESOURCE_ORDER_BUDGET_SEARCH;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestOrderBudgetSearchAttributesTransfer::class;
    }
}
