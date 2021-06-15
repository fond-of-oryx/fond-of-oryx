<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;

class SplittableCheckoutFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutBusinessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutWorkflowMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutFacadeInterface
     */
    protected $splittableCheckoutFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableCheckoutResponseTransferMock = $this->getMockBuilder(SplittableCheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutBusinessFactoryMock = $this->getMockBuilder(SplittableCheckoutBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutWorkflowMock = $this->getMockBuilder(SplittableCheckoutWorkflowInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutFacade = new SplittableCheckoutFacade();
        $this->splittableCheckoutFacade->setFactory($this->splittableCheckoutBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $this->splittableCheckoutBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createSplittableCheckoutWorkflow')
            ->willReturn($this->splittableCheckoutWorkflowMock);

        $this->splittableCheckoutWorkflowMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->willReturn($this->splittableCheckoutResponseTransferMock);

        static::assertEquals(
            $this->splittableCheckoutResponseTransferMock,
            $this->splittableCheckoutFacade->placeOrder($this->quoteTransferMock)
        );
    }
}
