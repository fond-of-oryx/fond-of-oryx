<?php

namespace FondOfOryx\Zed\CustomerApi\Communication\Plugin\ApiExtension;

use FondOfOryx\Zed\CustomerApi\CustomerApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\ApiExtension\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerApi\Business\CustomerApiFacadeInterface getFacade()
 */
class CustomerApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return CustomerApiConfig::RESOURCE_CUSTOMERS;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        return $this->getFacade()->validateApiRequest($apiRequestTransfer);
    }
}
