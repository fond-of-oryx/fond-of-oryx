<?php

namespace FondOfOryx\Zed\CreditMemoApi\Communication\Plugin\Api;

use FondOfOryx\Zed\CreditMemoApi\CreditMemoApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\ApiExtension\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CreditMemoApi\Business\CreditMemoApiFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\CreditMemoApi\Business\CreditMemoApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\CreditMemoApi\CreditMemoApiConfig getConfig()
 */
class CreditMemoApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return CreditMemoApiConfig::RESOURCE_CREDIT_MEMO;
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
