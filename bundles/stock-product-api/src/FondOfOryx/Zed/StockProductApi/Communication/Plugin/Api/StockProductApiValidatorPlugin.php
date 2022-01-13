<?php

namespace FondOfOryx\Zed\StockProductApi\Communication\Plugin\Api;

use FondOfOryx\Zed\StockProductApi\StockProductApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
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
    public function getResourceName()
    {
        return StockProductApiConfig::RESOURCE_STOCK_PRODUCT;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiDataTransfer $apiDataTransfer)
    {
        return $this->getFacade()->validate($apiDataTransfer);
    }
}
