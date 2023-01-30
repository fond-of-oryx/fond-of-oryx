<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Communication\Plugin\Api;

use FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\ApiExtension\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiConfig getConfig()
 * @method \FondOfOryx\Zed\ErpInvoiceApi\Business\ErpInvoiceApiFacadeInterface getFacade()
 */
class ErpInvoiceApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ErpInvoiceApiConfig::RESOURCE_ERP_INVOICES;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        return $this->getFacade()->validateErpInvoice($apiRequestTransfer);
    }
}
