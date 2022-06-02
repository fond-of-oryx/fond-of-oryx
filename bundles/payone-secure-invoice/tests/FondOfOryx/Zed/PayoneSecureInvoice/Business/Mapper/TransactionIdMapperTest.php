<?php

namespace tests\FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Shared\PayoneSecureInvoice\PayoneSecureInvoiceConstants;
use FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\TransactionIdMapper;
use FondOfOryx\Zed\PayoneSecureInvoice\Persistence\PayoneSecureInvoiceRepository;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\CaptureContainer;

class TransactionIdMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\PayoneSecureInvoice\Persistence\PayoneSecureInvoiceRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\TransactionIdMapper
     */
    protected $mapper;

    /**
     * @var \SprykerEco\Zed\Payone\Business\Api\Request\Container\AuthorizationContainer
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
     * @var string
     */
    protected const TXID = '123456789';

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->payoneRequestContainer = new CaptureContainer();
        $this->payoneRequestContainer->setAid(static::AID);
        $this->payoneRequestContainer->setPortalid(static::PID);
        $this->payoneRequestContainer->setKey(static::KEY);
        $this->payoneRequestContainer->setTxid(static::TXID);

        $this->repositoryMock = $this->getMockBuilder(PayoneSecureInvoiceRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new TransactionIdMapper($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testMapper(): void
    {
        $testCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => '12345',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => '54321',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => 'abc123',
        ];

        $this->repositoryMock->method('getPaymentMethodByTxId')->willReturn('payment.payone.security_invoice');

        $mappedContainer = $this->mapper->map($this->payoneRequestContainer, $testCreds);

        $actualCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => $mappedContainer->getAid(),
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => $mappedContainer->getPortalid(),
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => $mappedContainer->getKey(),
        ];

        $this->assertSame($testCreds, $actualCreds);
    }

    /**
     * @return void
     */
    public function testIncorrectPaymentMethod(): void
    {
        $this->repositoryMock->method('getPaymentMethodByTxId')->willReturn('payment.payone.e_wallet');

        $testCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => '12345',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => '54321',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => 'abc123',
        ];

        $mappedContainer = $this->mapper->map($this->payoneRequestContainer, $testCreds);

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
}
