<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Validator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriterInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ProductListRestrictionValidatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserWriterInterface|MockObject $companyUserWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpanderInterface
     */
    protected MockObject|QuoteExpanderInterface $quoteExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface
     */
    protected MockObject|BusinessOnBehalfProductListConnectorToProductListFacadeInterface $productListFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CartChangeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CartChangeTransfer|MockObject $cartChangeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CartPreCheckResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CartPreCheckResponseTransfer|MockObject $cartPreCheckResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Validator\ProductListRestrictionValidator
     */
    protected ProductListRestrictionValidator $productListRestrictionValidator;

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

        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartPreCheckResponseTransferMock = $this->getMockBuilder(CartPreCheckResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListRestrictionValidator = new ProductListRestrictionValidator(
            $this->companyUserWriterMock,
            $this->quoteExpanderMock,
            $this->productListFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getQuote')
            ->willReturn($this->quoteTransferMock);

        $this->companyUserWriterMock->expects(static::atLeastOnce())
            ->method('setDefaultByQuote')
            ->with($this->quoteTransferMock);

        $this->quoteExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('setQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->cartChangeTransferMock);

        $this->productListFacadeMock->expects(static::atLeastOnce())
            ->method('validateItemAddProductListRestrictions')
            ->with($this->cartChangeTransferMock)
            ->willReturn($this->cartPreCheckResponseTransferMock);

        static::assertEquals(
            $this->cartPreCheckResponseTransferMock,
            $this->productListRestrictionValidator->validate($this->cartChangeTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testValidateWithInvalidData(): void
    {
        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getQuote')
            ->willReturn(null);

        $this->companyUserWriterMock->expects(static::never())
            ->method('setDefaultByQuote');

        $this->quoteExpanderMock->expects(static::never())
            ->method('expand');

        $this->cartChangeTransferMock->expects(static::never())
            ->method('setQuote');

        $this->productListFacadeMock->expects(static::never())
            ->method('validateItemAddProductListRestrictions');

        $cartChangeTransfer = $this->productListRestrictionValidator->validate($this->cartChangeTransferMock);

        static::assertFalse($cartChangeTransfer->getIsSuccess());
    }
}
