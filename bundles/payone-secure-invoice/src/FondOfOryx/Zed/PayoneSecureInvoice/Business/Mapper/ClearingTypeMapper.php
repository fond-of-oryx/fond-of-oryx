<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper;

use FondOfOryx\Shared\PayoneSecureInvoice\PayoneSecureInvoiceConstants;
use SprykerEco\Shared\Payone\PayoneApiConstants;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\Authorization\AbstractAuthorizationContainer;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface;
use SprykerEco\Zed\Payone\Business\Key\HashGeneratorInterface;

class ClearingTypeMapper implements ClearingTypeMapperInterface
{
    /**
     * @var \SprykerEco\Zed\Payone\Business\Key\HashGeneratorInterface
     */
    protected $hashGenerator;

    /**
     * @param \SprykerEco\Zed\Payone\Business\Key\HashGeneratorInterface $hashGenerator
     */
    public function __construct(HashGeneratorInterface $hashGenerator)
    {
        $this->hashGenerator = $hashGenerator;
    }

    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\Authorization\AbstractAuthorizationContainer $requestContainer
     * @param array<string, string> $credentials
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function map(AbstractAuthorizationContainer $requestContainer, array $credentials): ContainerInterface
    {
        if ($requestContainer->getClearingType() !== PayoneApiConstants::CLEARING_TYPE_INVOICE) {
            return $requestContainer;
        }

        $requestContainer->setAid($credentials[PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID]);
        $requestContainer->setPortalid($credentials[PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID]);
        $requestContainer->setKey($this->hashGenerator->hash($credentials[PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY]));

        return $requestContainer;
    }
}
