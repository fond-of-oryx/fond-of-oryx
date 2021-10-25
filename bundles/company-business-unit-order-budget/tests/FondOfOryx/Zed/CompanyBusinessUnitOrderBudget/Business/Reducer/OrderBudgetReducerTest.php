<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reducer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\PermissionExtension\AlterCartWithoutLimitPermissionPlugin;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class OrderBudgetReducerTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderBudgetTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetTransferMock;

    /**
     * @var \Generated\Shared\Transfer\TotalsTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $totalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $permissionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reducer\OrderBudgetReducer
     */
    protected $orderBudgetReducer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetTransferMock = $this->getMockBuilder(OrderBudgetTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetFacadeMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionFacadeMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetReducer = new OrderBudgetReducer(
            $this->orderBudgetFacadeMock,
            $this->permissionFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testReduceByQuote(): void
    {
        $idCompanyUser = 1;
        $currentBudget = 1000;
        $subtotal = 500;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('requireCompanyUser')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('requireIdCompanyUser')
            ->willReturn($this->quoteTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUser')
            ->willReturn($idCompanyUser);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(AlterCartWithoutLimitPermissionPlugin::KEY, $idCompanyUser)
            ->willReturn(false);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('requireCompanyBusinessUnit')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('requireOrderBudget')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getOrderBudget')
            ->willReturn($this->orderBudgetTransferMock);

        $this->orderBudgetTransferMock->expects(static::atLeastOnce())
            ->method('requireBudget')
            ->willReturn($this->orderBudgetTransferMock);

        $this->orderBudgetTransferMock->expects(static::atLeastOnce())
            ->method('getBudget')
            ->willReturn($currentBudget);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('requireTotals')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('requireSubtotal')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getSubtotal')
            ->willReturn($subtotal);

        $this->orderBudgetTransferMock->expects(static::atLeastOnce())
            ->method('setBudget')
            ->with($currentBudget - $subtotal)
            ->willReturn($this->orderBudgetTransferMock);

        $this->orderBudgetFacadeMock->expects(static::atLeastOnce())
            ->method('updateOrderBudget')
            ->with($this->orderBudgetTransferMock);

        $this->orderBudgetReducer->reduceByQuote($this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testReduceByQuoteWithUnlimitedPermission(): void
    {
        $idCompanyUser = 1;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('requireCompanyUser')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('requireIdCompanyUser')
            ->willReturn($this->quoteTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUser')
            ->willReturn($idCompanyUser);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(AlterCartWithoutLimitPermissionPlugin::KEY, $idCompanyUser)
            ->willReturn(true);

        $this->companyUserTransferMock->expects(static::never())
            ->method('requireCompanyBusinessUnit');

        $this->companyUserTransferMock->expects(static::never())
            ->method('getCompanyBusinessUnit');

        $this->quoteTransferMock->expects(static::never())
            ->method('requireTotals');

        $this->quoteTransferMock->expects(static::never())
            ->method('getTotals');

        $this->orderBudgetFacadeMock->expects(static::never())
            ->method('updateOrderBudget');

        $this->orderBudgetReducer->reduceByQuote($this->quoteTransferMock);
    }
}
