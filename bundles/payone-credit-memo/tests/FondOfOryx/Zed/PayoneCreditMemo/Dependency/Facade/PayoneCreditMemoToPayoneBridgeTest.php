<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Generated\Shared\Transfer\RefundResponseTransfer;
use SprykerEco\Zed\Payone\Business\PayoneFacade;

class PayoneCreditMemoToPayoneBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\Payone\Business\PayoneFacade
     */
    protected $payoneFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    protected $payonePartialOperationRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToPayoneInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->payoneFacadeMock = $this->getMockBuilder(PayoneFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->payonePartialOperationRequestTransferMock = $this->getMockBuilder(PayonePartialOperationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new PayoneCreditMemoToPayoneBridge($this->payoneFacadeMock);
    }

    /**
     * @return void
     */
    public function testExecutePartialRefund(): void
    {
        static::assertInstanceOf(
            RefundResponseTransfer::class,
            $this->bridge->executePartialRefund($this->payonePartialOperationRequestTransferMock),
        );
    }
}
