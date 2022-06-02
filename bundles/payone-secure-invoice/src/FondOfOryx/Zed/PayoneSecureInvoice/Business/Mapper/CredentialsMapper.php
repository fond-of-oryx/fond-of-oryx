<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper;

use FondOfOryx\Shared\PayoneSecureInvoice\PayoneSecureInvoiceConstants;
use FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig;
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
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\TransactionIdMapperInterface
     */
    protected $transactionIdMapper;

    /**
     * @var \FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\ClearingTypeMapperInterface $clearingTypeMapper
     * @param \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\TransactionIdMapperInterface $transactionIdMapper
     * @param \FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig $config
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        ClearingTypeMapperInterface $clearingTypeMapper,
        TransactionIdMapperInterface $transactionIdMapper,
        PayoneSecureInvoiceConfig $config,
        LoggerInterface $logger
    ) {
        $this->clearingTypeMapper = $clearingTypeMapper;
        $this->transactionIdMapper = $transactionIdMapper;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface $requestContainer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function map(ContainerInterface $requestContainer): ContainerInterface
    {
        $credentials = $this->config->getCredentials();
        if (count($credentials) === 0) {
            return $requestContainer;
        }

        if ($this->allCredentialsSet($credentials)) {
            $this->logger->warning(sprintf('[%s]: %s', static::NAME, 'One ore more necessary credentials are not set.'));

            return $requestContainer;
        }

        if ($this->isCredentialMissing($credentials)) {
            $this->logger->warning(sprintf('[%s]: %s', static::NAME, 'One ore more necessary credentials are missing.'));

            return $requestContainer;
        }

        if ($requestContainer instanceof AbstractAuthorizationContainer) {
            return $this->clearingTypeMapper->map($requestContainer, $credentials);
        }

        if (method_exists($requestContainer, 'getTxid')) {
            return $this->transactionIdMapper->map($requestContainer, $credentials);
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
