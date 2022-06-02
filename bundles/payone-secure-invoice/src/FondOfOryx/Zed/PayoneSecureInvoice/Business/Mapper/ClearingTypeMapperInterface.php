<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper;

use SprykerEco\Zed\Payone\Business\Api\Request\Container\Authorization\AbstractAuthorizationContainer;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface;

interface ClearingTypeMapperInterface
{
    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\Authorization\AbstractAuthorizationContainer $requestContainer
     * @param array $credentials
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function map(AbstractAuthorizationContainer $requestContainer, array $credentials): ContainerInterface;
}
