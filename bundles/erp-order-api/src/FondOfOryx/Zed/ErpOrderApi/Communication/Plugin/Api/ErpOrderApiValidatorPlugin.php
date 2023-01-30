<?php

namespace FondOfOryx\Zed\ErpOrderApi\Communication\Plugin\Api;

use FondOfOryx\Zed\ErpOrderApi\ErpOrderApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\ApiExtension\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpOrderApi\ErpOrderApiConfig getConfig()
 * @method \FondOfOryx\Zed\ErpOrderApi\Business\ErpOrderApiFacadeInterface getFacade()
 */
class ErpOrderApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ErpOrderApiConfig::RESOURCE_ERP_ORDERS;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        return $this->getFacade()->validateErpOrder($apiRequestTransfer);
    }
}
