<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Filter\RestrictedItemsFilterInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Validator\ProductListRestrictionValidatorInterface;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class BusinessOnBehalfProductListConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\BusinessOnBehalfProductListConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfProductListConnectorBusinessFactory $factoryMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Validator\ProductListRestrictionValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|ProductListRestrictionValidatorInterface $productListRestrictionValidatorMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Filter\RestrictedItemsFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestrictedItemsFilterInterface|MockObject $restrictedItemsFilterMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CartChangeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CartChangeTransfer|MockObject $cartChangeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CartPreCheckResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CartPreCheckResponseTransfer|MockObject $cartPreCheckResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\BusinessOnBehalfProductListConnectorFacade
     */
    protected BusinessOnBehalfProductListConnectorFacade $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListRestrictionValidatorMock = $this->getMockBuilder(ProductListRestrictionValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restrictedItemsFilterMock = $this->getMockBuilder(RestrictedItemsFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartPreCheckResponseTransferMock = $this->getMockBuilder(CartPreCheckResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new BusinessOnBehalfProductListConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testValidateItemAddProductListRestrictions(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductListRestrictionValidator')
            ->willReturn($this->productListRestrictionValidatorMock);

        $this->productListRestrictionValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->cartChangeTransferMock)
            ->willReturn($this->cartPreCheckResponseTransferMock);

        static::assertEquals(
            $this->cartPreCheckResponseTransferMock,
            $this->facade->validateItemAddProductListRestrictions($this->cartChangeTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testFilterRestrictedItems(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRestrictedItemsFilter')
            ->willReturn($this->restrictedItemsFilterMock);

        $this->restrictedItemsFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->filterRestrictedItems($this->quoteTransferMock),
        );
    }
}
