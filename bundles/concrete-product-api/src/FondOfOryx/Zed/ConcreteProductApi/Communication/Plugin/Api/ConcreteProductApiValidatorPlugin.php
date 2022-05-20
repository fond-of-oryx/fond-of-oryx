<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Communication\Plugin\Api;

use FondOfOryx\Zed\ConcreteProductApi\ConcreteProductApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ConcreteProductApi\ConcreteProductApiConfig getConfig()
 * @method \FondOfOryx\Zed\ConcreteProductApi\Business\ConcreteProductApiFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ConcreteProductApi\Persistence\ConcreteProductApiQueryContainerInterface getQueryContainer()
 */
class ConcreteProductApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        return ConcreteProductApiConfig::RESOURCE_CONCRETE_PRODUCTS;
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFacade()->validate($apiDataTransfer);
    }
}
