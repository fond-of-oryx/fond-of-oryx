<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\PermissionExtension\AlterCartWithoutLimitPermissionPlugin;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class QuoteExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $permissionFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderBudgetTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetTransferMock;

    /**
     * @var \Generated\Shared\Transfer\TotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $totalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\QuoteExpander
     */
    protected $quoteExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->permissionFacadeMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

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

        $this->quoteExpander = new QuoteExpander(
            $this->permissionFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $fkCompany = 1;
        $currentBudget = 1000;
        $subtotal = 500;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn($fkCompany);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(AlterCartWithoutLimitPermissionPlugin::KEY, $fkCompany)
            ->willReturn(false);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getOrderBudget')
            ->willReturn($this->orderBudgetTransferMock);

        $this->orderBudgetTransferMock->expects(static::atLeastOnce())
            ->method('getBudget')
            ->willReturn($currentBudget);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getSubtotal')
            ->willReturn($subtotal);

        $this->quoteTransferMock->expects(static::never())
            ->method('addValidationMessage');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithUnlimitedPermission(): void
    {
        $fkCompany = 1;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn($fkCompany);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(AlterCartWithoutLimitPermissionPlugin::KEY, $fkCompany)
            ->willReturn(true);

        $this->companyUserTransferMock->expects(static::never())
            ->method('getCompanyBusinessUnit');

        $this->quoteTransferMock->expects(static::never())
            ->method('getTotals');

        $this->quoteTransferMock->expects(static::never())
            ->method('addValidationMessage');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutSufficient(): void
    {
        $fkCompany = 1;
        $currentBudget = 100;
        $subtotal = 500;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn($fkCompany);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(AlterCartWithoutLimitPermissionPlugin::KEY, $fkCompany)
            ->willReturn(false);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getOrderBudget')
            ->willReturn($this->orderBudgetTransferMock);

        $this->orderBudgetTransferMock->expects(static::atLeastOnce())
            ->method('getBudget')
            ->willReturn($currentBudget);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getSubtotal')
            ->willReturn($subtotal);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('addValidationMessage')
            ->with(
                static::callback(
                    static function (MessageTransfer $messageTransfer) {
                        return $messageTransfer->getType() === QuoteExpander::MESSAGE_TYPE_ERROR
                            && $messageTransfer->getValue() === QuoteExpander::MESSAGE_NOT_ENOUGH_ORDER_BUDGET;
                    }
                )
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutSubtotals(): void
    {
        $fkCompany = 1;
        $currentBudget = 100;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn($fkCompany);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(AlterCartWithoutLimitPermissionPlugin::KEY, $fkCompany)
            ->willReturn(false);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getOrderBudget')
            ->willReturn($this->orderBudgetTransferMock);

        $this->orderBudgetTransferMock->expects(static::atLeastOnce())
            ->method('getBudget')
            ->willReturn($currentBudget);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getSubtotal')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('addValidationMessage')
            ->with(
                static::callback(
                    static function (MessageTransfer $messageTransfer) {
                        return $messageTransfer->getType() === QuoteExpander::MESSAGE_TYPE_ERROR
                            && $messageTransfer->getValue() === QuoteExpander::MESSAGE_NO_SUBTOTALS;
                    }
                )
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutOrderBudget(): void
    {
        $fkCompany = 1;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn($fkCompany);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(AlterCartWithoutLimitPermissionPlugin::KEY, $fkCompany)
            ->willReturn(false);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getOrderBudget')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::never())
            ->method('getTotals');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('addValidationMessage')
            ->with(
                static::callback(
                    static function (MessageTransfer $messageTransfer) {
                        return $messageTransfer->getType() === QuoteExpander::MESSAGE_TYPE_ERROR
                            && $messageTransfer->getValue() === QuoteExpander::MESSAGE_NO_ORDER_BUDGET;
                    }
                )
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutCompanyBusinessUnit(): void
    {
        $fkCompany = 1;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn($fkCompany);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(AlterCartWithoutLimitPermissionPlugin::KEY, $fkCompany)
            ->willReturn(false);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::never())
            ->method('getTotals');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('addValidationMessage')
            ->with(
                static::callback(
                    static function (MessageTransfer $messageTransfer) {
                        return $messageTransfer->getType() === QuoteExpander::MESSAGE_TYPE_ERROR
                            && $messageTransfer->getValue() === QuoteExpander::MESSAGE_NOT_ASSIGNED_TO_COMPANY_BUSINESS_UNIT;
                    }
                )
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutCompanyUser(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn(null);

        $this->permissionFacadeMock->expects(static::never())
            ->method('can');

        $this->quoteTransferMock->expects(static::never())
            ->method('getTotals');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('addValidationMessage')
            ->with(
                static::callback(
                    static function (MessageTransfer $messageTransfer) {
                        return $messageTransfer->getType() === QuoteExpander::MESSAGE_TYPE_ERROR
                            && $messageTransfer->getValue() === QuoteExpander::MESSAGE_NOT_OWNED_BY_COMPANY_USER;
                    }
                )
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock)
        );
    }
}
