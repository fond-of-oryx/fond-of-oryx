<?php

namespace FondOfOryx\Zed\InvoiceApi\Communication\Plugin\Api;

use FondOfOryx\Zed\InvoiceApi\InvoiceApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
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
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFacade()->validate($apiDataTransfer);
    }
}
