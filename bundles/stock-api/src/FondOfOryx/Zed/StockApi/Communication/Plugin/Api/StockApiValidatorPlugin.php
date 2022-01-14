<?php

namespace FondOfOryx\Zed\StockApi\Communication\Plugin\Api;

use FondOfOryx\Zed\StockApi\StockApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\StockApi\Business\StockApiFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\StockApi\Business\StockApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\StockApi\StockApiConfig getConfig()
 * @method \FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainerInterface getQueryContainer()
 */
class StockApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @api
     *
     * @return string
     */
    public function getResourceName()
    {
        return StockApiConfig::RESOURCE_STOCK;
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
