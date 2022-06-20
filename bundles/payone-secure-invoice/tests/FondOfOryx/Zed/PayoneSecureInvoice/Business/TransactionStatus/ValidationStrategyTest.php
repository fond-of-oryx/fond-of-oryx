<?php

namespace tests\FondOfOryx\Zed\PayoneSecureInvoice\Business\TransactionStatus;

use Codeception\Test\Unit;
use FondOfOryx\Shared\PayoneSecureInvoice\PayoneSecureInvoiceConstants;
use FondOfOryx\Zed\PayoneSecureInvoice\Business\TransactionStatus\ValidationStrategy;
use FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig;
use Generated\Shared\Transfer\PayoneStandardParameterTransfer;
use SprykerEco\Shared\Payone\PayoneApiConstants;
use SprykerEco\Zed\Payone\Business\Api\TransactionStatus\TransactionStatusRequest;
use SprykerEco\Zed\Payone\Business\Api\TransactionStatus\TransactionStatusResponse;
use SprykerEco\Zed\Payone\Business\Key\HashGenerator;
use SprykerEco\Zed\Payone\Business\Key\HashProvider;

class ValidationStrategyTest extends Unit
{
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
     * @var \FondOfOryx\Zed\PayoneSecureInvoice\Business\TransactionStatus\ValidationStrategy
     */
    protected $validationStrategy;

    /**
     * @var \SprykerEco\Zed\Payone\Business\Api\TransactionStatus\TransactionStatusRequest
     */
    protected $transactionStatusRequest;

    /**
     * @var \Generated\Shared\Transfer\PayoneStandardParameterTransfer
     */
    protected $standardParameter;

    /**
     * @var \SprykerEco\Zed\Payone\Business\Key\HashGenerator
     */
    protected $hashGenerator;

    /**
     * @var \FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->hashGenerator = new HashGenerator(
            new HashProvider(),
        );

        $this->configMock = $this->getMockBuilder(PayoneSecureInvoiceConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->validationStrategy = new ValidationStrategy($this->hashGenerator, $this->configMock);
        $this->transactionStatusRequest = new TransactionStatusRequest();
        $this->standardParameter = (new PayoneStandardParameterTransfer())
            ->setAid(static::AID)
            ->setPortalId(static::PID)
            ->setKey(static::KEY);
    }

    /**
     * @return void
     */
    public function testInvoiceCredentials(): void
    {
        $testCreds = [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => '12345',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => '54321',
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => 'abc123',
        ];

        $this->configMock->method('getCredentials')->willReturn($testCreds);

        $this->transactionStatusRequest->setKey($this->hashGenerator->hash('abc123'));
        $this->transactionStatusRequest->setAid('12345');
        $this->transactionStatusRequest->setPortalid('54321');
        $this->transactionStatusRequest->setClearingtype(PayoneApiConstants::CLEARING_TYPE_INVOICE);

        $result = $this->validationStrategy->validate($this->transactionStatusRequest, $this->standardParameter);
        $this->assertTrue($result);
    }

    /**
     * @return void
     */
    public function testDefaultCredentials(): void
    {
        $this->transactionStatusRequest->setKey($this->hashGenerator->hash(static::KEY));
        $this->transactionStatusRequest->setAid(static::AID);
        $this->transactionStatusRequest->setPortalid(static::PID);
        $this->transactionStatusRequest->setClearingtype(PayoneApiConstants::CLEARING_TYPE_E_WALLET);

        $result = $this->validationStrategy->validate($this->transactionStatusRequest, $this->standardParameter);

        $this->assertTrue($result);
    }

    /**
     * @return void
     */
    public function testInvalidCredentials(): void
    {
        $this->transactionStatusRequest->setKey('0000');
        $this->transactionStatusRequest->setAid('0000');
        $this->transactionStatusRequest->setPortalid('0000');
        $this->transactionStatusRequest->setClearingtype(PayoneApiConstants::CLEARING_TYPE_E_WALLET);

        $result = $this->validationStrategy->validate($this->transactionStatusRequest, $this->standardParameter);
        $this->assertInstanceOf(TransactionStatusResponse::class, $result);
    }
}
