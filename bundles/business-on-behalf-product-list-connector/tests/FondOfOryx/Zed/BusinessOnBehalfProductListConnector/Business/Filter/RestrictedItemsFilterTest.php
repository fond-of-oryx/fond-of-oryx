<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriterInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RestrictedItemsFilterTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserWriterInterface|MockObject $companyUserWriterMock;

    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpanderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QuoteExpanderInterface $quoteExpanderMock;

    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfProductListConnectorToProductListFacadeInterface $productListFacadeMock;

    /**
     * @var (\Generated\Shared\Transfer\QuoteTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Filter\RestrictedItemsFilter
     */
    protected RestrictedItemsFilter $restrictedItemsFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserWriterMock = $this->getMockBuilder(CompanyUserWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpanderMock = $this->getMockBuilder(QuoteExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListFacadeMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorToProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restrictedItemsFilter = new RestrictedItemsFilter(
            $this->companyUserWriterMock,
            $this->quoteExpanderMock,
            $this->productListFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testFilter(): void
    {
        $this->companyUserWriterMock->expects(static::atLeastOnce())
            ->method('setDefaultByQuote')
            ->with($this->quoteTransferMock);

        $this->quoteExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->productListFacadeMock->expects(static::atLeastOnce())
            ->method('filterRestrictedItems')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->restrictedItemsFilter->filter($this->quoteTransferMock),
        );
    }
}
