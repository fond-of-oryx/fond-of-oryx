<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper;

use FondOfOryx\Shared\PayoneSecureInvoice\PayoneSecureInvoiceConstants;
use SprykerEco\Shared\Payone\PayoneApiConstants;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\Authorization\AbstractAuthorizationContainer;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface;

class ClearingTypeMapper implements ClearingTypeMapperInterface
{
    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\Authorization\AbstractAuthorizationContainer $requestContainer
     * @param array<string, string> $credentials
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function map(AbstractAuthorizationContainer $requestContainer, array $credentials): ContainerInterface
    {
        if (
            $requestContainer->getClearingType() !== PayoneApiConstants::CLEARING_TYPE_INVOICE &&
            $requestContainer->getClearingsubtype() !== PayoneApiConstants::CLEARING_SUBTYPE_SECURITY_INVOICE
        ) {
            return $requestContainer;
        }

        $requestContainer->setAid($credentials[PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID]);
        $requestContainer->setPortalid($credentials[PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID]);
        $requestContainer->setKey($credentials[PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY]);

        return $requestContainer;
    }
}
