<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Communication\Plugin\Payone;

use Generated\Shared\Transfer\PayoneStandardParameterTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface;
use SprykerEco\Zed\Payone\Dependency\Plugin\StandardParameterMapperPluginInterface;

/**
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\Business\PayoneSecureInvoiceFacade getFacade()
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig getConfig()
 */
class SecureInvoiceDedicatedCredentialsPlugin extends AbstractPlugin implements StandardParameterMapperPluginInterface
{
    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface $requestContainer
     * @param \Generated\Shared\Transfer\PayoneStandardParameterTransfer $standardParameter
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function map(ContainerInterface $requestContainer, PayoneStandardParameterTransfer $standardParameter): ContainerInterface
    {
        return $this->getFacade()->mapCredentials($requestContainer);
    }
}
