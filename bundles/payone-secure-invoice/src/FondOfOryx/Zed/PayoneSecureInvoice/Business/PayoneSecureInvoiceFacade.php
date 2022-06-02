<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface;

/**
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\Business\PayoneSecureInvoiceBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\Persistence\PayoneSecureInvoiceRepositoryInterface getRepository()
 */
class PayoneSecureInvoiceFacade extends AbstractFacade implements PayoneSecureInvoiceFacadeInterface
{
    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface $requestContainer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function mapCredentials(ContainerInterface $requestContainer): ContainerInterface
    {
        return $this->getFactory()->createCredentialsMapper()->map($requestContainer);
    }
}
