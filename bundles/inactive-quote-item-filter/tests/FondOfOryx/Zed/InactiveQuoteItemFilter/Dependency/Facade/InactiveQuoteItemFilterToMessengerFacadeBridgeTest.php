<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\MessageTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Messenger\Business\MessengerFacadeInterface;

class InactiveQuoteItemFilterToMessengerFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Messenger\Business\MessengerFacadeInterface
     */
    protected MockObject|MessengerFacadeInterface $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\MessageTransfer
     */
    protected MockObject|MessageTransfer $messageTransferMock;

    /**
     * @var \FondOfOryx\Zed\InactiveQuoteItemFilter\Dependency\Facade\InactiveQuoteItemFilterToMessengerFacadeBridge
     */
    protected InactiveQuoteItemFilterToMessengerFacadeBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(MessengerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->messageTransferMock = $this->getMockBuilder(MessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new InactiveQuoteItemFilterToMessengerFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testAddInfoMessage(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('addInfoMessage')
            ->with($this->messageTransferMock);

        $this->bridge->addInfoMessage($this->messageTransferMock);
    }
}
