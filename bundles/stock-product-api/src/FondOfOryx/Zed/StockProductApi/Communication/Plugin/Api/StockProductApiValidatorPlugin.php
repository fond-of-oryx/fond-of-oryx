<?php

namespace FondOfOryx\Zed\StockProductApi\Communication\Plugin\Api;

use FondOfOryx\Zed\StockProductApi\StockProductApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\ApiExtension\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\StockProductApi\Business\StockProductApiFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\StockProductApi\Business\StockProductApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\StockProductApi\StockProductApiConfig getConfig()
 * @method \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiQueryContainerInterface getQueryContainer()
 */
class StockProductApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        return StockProductApiConfig::RESOURCE_STOCK_PRODUCT;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        return $this->getFacade()->validate($apiRequestTransfer);
    }
}
