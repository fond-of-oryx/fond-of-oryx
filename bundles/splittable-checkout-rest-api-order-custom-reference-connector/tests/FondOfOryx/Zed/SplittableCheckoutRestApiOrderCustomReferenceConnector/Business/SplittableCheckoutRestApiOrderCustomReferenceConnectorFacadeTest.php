<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\Expander\QuoteExpanderInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class SplittableCheckoutRestApiOrderCustomReferenceConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\Expander\QuoteExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteExpanderMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\SplittableCheckoutRestApiOrderCustomReferenceConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\SplittableCheckoutRestApiOrderCustomReferenceConnectorFacadeInterface
     */
    protected $facade;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteExpanderMock = $this->getMockBuilder(QuoteExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactoryMock = $this->getMockBuilder(SplittableCheckoutRestApiOrderCustomReferenceConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SplittableCheckoutRestApiOrderCustomReferenceConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testExpandQuote(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createQuoteExpander')
            ->willReturn($this->quoteExpanderMock);

        $this->quoteExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->expandQuote($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock),
        );
    }
}
