<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Communication\Plugin\Api;

use FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
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
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFacade()->validateErpInvoice($apiDataTransfer);
    }
}
