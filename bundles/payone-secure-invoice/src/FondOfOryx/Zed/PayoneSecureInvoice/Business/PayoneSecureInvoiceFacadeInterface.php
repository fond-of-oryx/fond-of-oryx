<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business;

use SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface;

interface PayoneSecureInvoiceFacadeInterface
{
    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface $requestContainer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function mapCredentials(ContainerInterface $requestContainer): ContainerInterface;
}
