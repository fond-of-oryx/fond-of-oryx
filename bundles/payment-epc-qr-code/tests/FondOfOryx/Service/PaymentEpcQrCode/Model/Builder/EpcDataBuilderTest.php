<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Model\Builder;

use Codeception\Test\Unit;
use Exception;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

class EpcDataBuilderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestTransferMock;

    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\Model\Builder\EpcDataBuilderInterface
     */
    protected $builder;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->requestTransferMock = $this->getMockBuilder(PaymentEpcQrCodeRequestTransfer::class)->disableOriginalConstructor()->getMock();

        $this->builder = new EpcDataBuilder();
    }

    /**
     * @return void
     */
    public function testFromTransfer(): void
    {
        $this->requestTransferMock->expects(static::once())->method('requireServiceTag')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireVersion')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireEncoding')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireType')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireBic')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireReceiverName')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireIban')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireAmount')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('getUsage')->willReturn('usage');
        $this->requestTransferMock->expects(static::once())->method('getReference');
        $this->requestTransferMock->expects(static::once())->method('getPurpose');
        $this->requestTransferMock->expects(static::once())->method('getServiceTag')->willReturn('usage');
        $this->requestTransferMock->expects(static::once())->method('getVersion')->willReturn('002');
        $this->requestTransferMock->expects(static::once())->method('getEncoding')->willReturn(1);
        $this->requestTransferMock->expects(static::once())->method('getType')->willReturn('SCT');
        $this->requestTransferMock->expects(static::once())->method('getBic')->willReturn('BIC');
        $this->requestTransferMock->expects(static::once())->method('getReceiverName')->willReturn('John Doe');
        $this->requestTransferMock->expects(static::once())->method('getIban')->willReturn('DE00000000000000000000');
        $this->requestTransferMock->expects(static::once())->method('getAmount')->willReturn('99,95');

        $string = $this->builder->fromTransfer($this->requestTransferMock);
        $compare = 'usage
002
1
SCT
BIC
John Doe
DE00000000000000000000
99,95


usage
';
        static::assertSame($compare, $string);
    }

    /**
     * @return void
     */
    public function testFromTransferThrowsException(): void
    {
        $this->requestTransferMock->expects(static::once())->method('requireServiceTag')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireVersion')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireEncoding')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireType')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireBic')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireReceiverName')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireIban')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::once())->method('requireAmount')->willReturn($this->requestTransferMock);
        $this->requestTransferMock->expects(static::exactly(2))->method('getUsage')->willReturn('usage');
        $this->requestTransferMock->expects(static::exactly(2))->method('getReference')->willReturn('reference');
        $this->requestTransferMock->expects(static::once())->method('getPurpose');

        $exception = null;
        try {
            $this->builder->fromTransfer($this->requestTransferMock);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNotNull($exception);
        static::assertSame('One of "Reference: (reference)" or "Usage: (usage)" must be null!', $exception->getMessage());
    }
}
