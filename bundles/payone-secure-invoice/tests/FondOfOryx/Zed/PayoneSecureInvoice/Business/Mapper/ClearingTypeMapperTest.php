<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Shared\PayoneSecureInvoice\PayoneSecureInvoiceConstants;
use SprykerEco\Shared\Payone\PayoneApiConstants;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\AuthorizationContainer;

class ClearingTypeMapperTest extends Unit
{
    /**
     * @var \SprykerEco\Zed\Payone\Business\Api\Request\Container\AuthorizationContainer;
     */
    protected $payoneRequestContainer;

    /**
     * @var string
     */
    protected const AID = '54321';

    /**
     * @var string
     */
    protected const PID = '12345';

    /**
     * @var string
     */
    protected const KEY = '123abc';

    /**
     * @return void
     */
    protected function _before()
    {
        $this->payoneRequestContainer = new AuthorizationContainer();
        $this->payoneRequestContainer->setClearingType(PayoneApiConstants::CLEARING_TYPE_SECURITY_INVOICE);
        $this->payoneRequestContainer->setClearingsubtype(PayoneApiConstants::CLEARING_SUBTYPE_SECURITY_INVOICE);
        $this->payoneRequestContainer->setAid(static::AID);
        $this->payoneRequestContainer->setPortalid(static::PID);
        $this->payoneRequestContainer->setKey(static::KEY);
    }

    /**
     * Credentials should be remapped for secure invoice clearing type
     *
     * @return void
     */
    public function testMapCredentials(): void
    {
        $testCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => '12345',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => '54321',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => 'abc123',
        ];

        $credentialsMapper = $this->createClearingTypeMapper();
        /**
         * @var \SprykerEco\Zed\Payone\Business\Api\Request\Container\AuthorizationContainer $mappedContainer
         */
        $mappedContainer = $credentialsMapper->map($this->payoneRequestContainer, $testCreds);

        $actualCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => $mappedContainer->getAid(),
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => $mappedContainer->getPortalid(),
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => $mappedContainer->getKey(),
        ];

        $this->assertSame($testCreds, $actualCreds);
    }

    /**
     *  Mapping should skip with incorrect clearing type
     *
     * @return void
     */
    public function testIncorrectPaymentMethod(): void
    {
        $testCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => '12345',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => '54321',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => 'abc123',
        ];

        $this->payoneRequestContainer->setClearingType(PayoneApiConstants::CLEARING_TYPE_E_WALLET);
        $this->payoneRequestContainer->setClearingsubtype('');

        $credentialsMapper = $this->createClearingTypeMapper();
        /**
         * @var \SprykerEco\Zed\Payone\Business\Api\Request\Container\AuthorizationContainer $mappedContainer
         */
        $mappedContainer = $credentialsMapper->map($this->payoneRequestContainer, $testCreds);

        $expectedCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => static::AID,
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => static::PID,
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => static::KEY,
        ];

        $actualCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => $mappedContainer->getAid(),
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => $mappedContainer->getPortalid(),
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => $mappedContainer->getKey(),
        ];

        $this->assertSame($expectedCreds, $actualCreds);
    }

    /**
     * @return \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\ClearingTypeMapperInterface
     */
    protected function createClearingTypeMapper(): ClearingTypeMapperInterface
    {
        return new ClearingTypeMapper();
    }
}
