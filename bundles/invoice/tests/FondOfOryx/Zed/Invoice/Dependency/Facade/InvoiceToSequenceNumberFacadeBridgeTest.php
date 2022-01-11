<?php

namespace FondOfOryx\Zed\Invoice\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;
use Spryker\Zed\SequenceNumber\Business\SequenceNumberFacade;

class InvoiceToSequenceNumberFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\SequenceNumber\Business\SequenceNumberFacade
     */
    protected $sequenceNumberFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SequenceNumberSettingsTransfer
     */
    protected $sequenceNumberSettingsTransferMock;

    /**
     * @var \FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToSequenceNumberFacadeInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->sequenceNumberFacadeMock = $this->getMockBuilder(SequenceNumberFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sequenceNumberSettingsTransferMock = $this->getMockBuilder(SequenceNumberSettingsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new InvoiceToSequenceNumberFacadeBridge($this->sequenceNumberFacadeMock);
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        $this->sequenceNumberFacadeMock->expects(static::atLeastOnce())
            ->method('generate')
            ->with($this->sequenceNumberSettingsTransferMock)
            ->willReturn('foo');

        static::assertEquals('foo', $this->bridge->generate($this->sequenceNumberSettingsTransferMock));
    }
}
