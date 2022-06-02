<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper;

use SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface;

interface TransactionIdMapperInterface
{
    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface $requestContainer
     * @param array $credentials
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function map(ContainerInterface $requestContainer, array $credentials): ContainerInterface;
}
