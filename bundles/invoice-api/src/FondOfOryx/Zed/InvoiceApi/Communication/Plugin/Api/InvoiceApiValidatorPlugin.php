<?php

namespace FondOfOryx\Zed\InvoiceApi\Communication\Plugin\Api;

use FondOfOryx\Zed\InvoiceApi\InvoiceApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\ApiExtension\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\InvoiceApi\Business\InvoiceApiFacade getFacade()
 * @method \FondOfOryx\Zed\InvoiceApi\InvoiceApiConfig getConfig()
 */
class InvoiceApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return InvoiceApiConfig::RESOURCE_INVOICE;
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
