<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper;

use SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface;

interface CredentialsMapperInterface
{
    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface $requestContainer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function map(ContainerInterface $requestContainer): ContainerInterface;
}
