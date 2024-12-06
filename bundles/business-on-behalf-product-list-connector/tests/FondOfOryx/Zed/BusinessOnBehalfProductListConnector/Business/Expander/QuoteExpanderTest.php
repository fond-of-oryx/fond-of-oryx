<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class QuoteExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerReaderInterface $customerReaderMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpander
     */
    protected QuoteExpander $quoteExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerReaderMock = $this->getMockBuilder(CustomerReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpander = new QuoteExpander($this->customerReaderMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->customerReaderMock->expects(static::atLeastOnce())
            ->method('getByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->customerTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUserTransfer')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyUser')
            ->with(null)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutCustomer(): void
    {
        $this->customerReaderMock->expects(static::atLeastOnce())
            ->method('getByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::never())
            ->method('setCustomer');

        $this->quoteTransferMock->expects(static::never())
            ->method('setCompanyUser');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock),
        );
    }
}
