<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Shared\PayoneSecureInvoice\PayoneSecureInvoiceConstants;
use Psr\Log\LoggerInterface;
use SprykerEco\Shared\Payone\PayoneApiConstants;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\AuthorizationContainer;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\CaptureContainer;

class CredentialsMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $logger;

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
     * @var \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\ClearingTypeMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clearingTypeMapperMock;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->clearingTypeMapperMock = $this->getMockBuilder(ClearingTypeMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->logger = $this->getMockBuilder(LoggerInterface::class)->getMock();

        $this->payoneRequestContainer = new AuthorizationContainer();
        $this->payoneRequestContainer->setClearingType(PayoneApiConstants::CLEARING_TYPE_SECURITY_INVOICE);
        $this->payoneRequestContainer->setClearingsubtype(PayoneApiConstants::CLEARING_SUBTYPE_SECURITY_INVOICE);
        $this->payoneRequestContainer->setAid(static::AID);
        $this->payoneRequestContainer->setPortalid(static::PID);
        $this->payoneRequestContainer->setKey(static::KEY);
    }

    /**
     * @return void
     */
    public function testIsPluginApplicable(): void
    {
        $testCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => '12345',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => '54321',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => 'abc123',
        ];

        $credentialsMapper = $this->createCredentialsMapper($testCreds);

        $authorizationContainer = new AuthorizationContainer();
        $this->clearingTypeMapperMock->expects(static::once())->method('map');

        $credentialsMapper->map($authorizationContainer);
    }

    /**
     * @return void
     */
    public function testIsPluginNotApplicable(): void
    {
        $testCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => '12345',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => '54321',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => 'abc123',
        ];

        $credentialsMapper = $this->createCredentialsMapper($testCreds);

        $captureContainer = new CaptureContainer();
        $this->clearingTypeMapperMock->expects(static::never())->method('map');

        $credentialsMapper->map($captureContainer);
    }

    /**
     * Mapping should be skipped if no credentials are passed
     *
     * @return void
     */
    public function testNoCredentialsConfigured(): void
    {
        $testCreds = [];

        $credentialsMapper = $this->createCredentialsMapper($testCreds);
        $mappedContainer = $credentialsMapper->map($this->payoneRequestContainer);

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
     * Mapping should be skipped if at least one credential is empty
     *
     * @return void
     */
    public function testNotAllCredentialsSet(): void
    {
        $testCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => '12345',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => '',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => '',
        ];

        $this->logger->expects(static::once())->method('warning');

        $credentialsMapper = $this->createCredentialsMapper($testCreds);
        $mappedContainer = $credentialsMapper->map($this->payoneRequestContainer);

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
     * Mapping should be skipped when property is missing
     * A warning should be logged
     *
     * @return void
     */
    public function testMissingCredential(): void
    {
        $testCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => '12345',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => '54321',
        ];

        $this->logger->expects(static::once())->method('warning');

        $credentialsMapper = $this->createCredentialsMapper($testCreds);
        $mappedContainer = $credentialsMapper->map($this->payoneRequestContainer);

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
     * @param array $testCreds
     *
     * @return \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\CredentialsMapperInterface
     */
    protected function createCredentialsMapper(array $testCreds): CredentialsMapperInterface
    {
        return new CredentialsMapper(
            $testCreds,
            $this->logger,
            $this->clearingTypeMapperMock,
        );
    }
}
