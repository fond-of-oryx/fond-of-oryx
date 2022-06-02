<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper;

use FondOfOryx\Shared\PayoneSecureInvoice\PayoneSecureInvoiceConstants;
use Psr\Log\LoggerInterface;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\Authorization\AbstractAuthorizationContainer;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface;

class CredentialsMapper implements CredentialsMapperInterface
{
    /**
     * @var string
     */
    protected const NAME = 'Payone Secure Invoice';

    /**
     * @var \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\ClearingTypeMapperInterface
     */
    protected $clearingTypeMapper;

    /**
     * @var array
     */
    protected $credentials;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param array $credentials
     * @param \Psr\Log\LoggerInterface $logger
     * @param \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\ClearingTypeMapperInterface $clearingTypeMapper
     */
    public function __construct(
        array $credentials,
        LoggerInterface $logger,
        ClearingTypeMapperInterface $clearingTypeMapper
    ) {
        $this->logger = $logger;
        $this->credentials = $credentials;
        $this->clearingTypeMapper = $clearingTypeMapper;
    }

    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface $requestContainer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function map(ContainerInterface $requestContainer): ContainerInterface
    {
        if (count($this->credentials) === 0) {
            return $requestContainer;
        }

        if ($this->allCredentialsSet($this->credentials)) {
            $this->logger->warning(sprintf('[%s]: %s', static::NAME, 'One ore more necessary credentials are not set.'));

            return $requestContainer;
        }

        if ($this->isCredentialMissing($this->credentials)) {
            $this->logger->warning(sprintf('[%s]: %s', static::NAME, 'One ore more necessary credentials are missing.'));

            return $requestContainer;
        }

        if ($requestContainer instanceof AbstractAuthorizationContainer) {
            return $this->clearingTypeMapper->map($requestContainer, $this->credentials);
        }

        return $requestContainer;
    }

    /**
     * @param array $credentials
     *
     * @return bool
     */
    protected function allCredentialsSet(array $credentials): bool
    {
        foreach ($credentials as $key => $credential) {
            if ($credentials[$key] === '') {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $credentials
     *
     * @return bool
     */
    protected function isCredentialMissing(array $credentials): bool
    {
        $requiredFields = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID,
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID,
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY,
        ];

        foreach ($requiredFields as $key) {
            if (!array_key_exists($key, $credentials)) {
                return true;
            }
        }

        return false;
    }
}
