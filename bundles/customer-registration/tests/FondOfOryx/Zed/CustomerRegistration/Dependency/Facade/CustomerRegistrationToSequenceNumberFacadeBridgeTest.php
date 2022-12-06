<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;
use Spryker\Zed\SequenceNumber\Business\SequenceNumberFacadeInterface;

class CustomerRegistrationToSequenceNumberFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeInterface
     */
    protected $facade;

    /**
     * @var \Spryker\Zed\SequenceNumber\Business\SequenceNumberFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $sequenceNumberFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\SequenceNumberSettingsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $sequenceNumberTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->sequenceNumberFacadeMock = $this->getMockBuilder(SequenceNumberFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sequenceNumberTransferMock = $this->getMockBuilder(SequenceNumberSettingsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerRegistrationToSequenceNumberFacadeBridge(
            $this->sequenceNumberFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        $this->sequenceNumberFacadeMock->expects(static::atLeastOnce())->method('generate')->willReturn('foobar');

        $this->facade->generate(
            $this->sequenceNumberTransferMock,
        );
    }
}
