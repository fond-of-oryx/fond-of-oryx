<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Exception\NotEnoughOrderBudgetException;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\PermissionExtension\AlterCartWithoutLimitPermissionPlugin;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class QuoteValidatorTest extends Unit
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
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidator
     */
    protected $quoteValidator;

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

        $this->quoteValidator = new QuoteValidator(
            $this->permissionFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
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

        try {
            $this->quoteValidator->validate($this->quoteTransferMock);
        } catch (Exception $exception) {
            static::fail();
        }
    }

    /**
     * @return void
     */
    public function testValidateWithUnlimitedPermission(): void
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
            ->willReturn($this->companyUserTransferMock);

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

        try {
            $this->quoteValidator->validate($this->quoteTransferMock);
        } catch (Exception $exception) {
            static::fail();
        }
    }

    /**
     * @return void
     */
    public function testValidateWithoutSufficient(): void
    {
        $idCompanyUser = 1;
        $currentBudget = 100;
        $subtotal = 500;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('requireCompanyUser')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('requireIdCompanyUser')
            ->willReturn($this->companyUserTransferMock);

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

        try {
            $this->quoteValidator->validate($this->quoteTransferMock);
            static::fail();
        } catch (Exception $exception) {
            static::assertInstanceOf(NotEnoughOrderBudgetException::class, $exception);
        }
    }

    /**
     * @return void
     */
    public function testValidateWithoutSubtotals(): void
    {
        $idCompanyUser = 1;
        $currentBudget = 100;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('requireCompanyUser')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('requireIdCompanyUser')
            ->willReturn($this->companyUserTransferMock);

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
            ->willThrowException(new RequiredTransferPropertyException());

        $this->totalsTransferMock->expects(static::never())
            ->method('getSubtotal');

        try {
            $this->quoteValidator->validate($this->quoteTransferMock);
            static::fail();
        } catch (Exception $exception) {
            static::assertInstanceOf(RequiredTransferPropertyException::class, $exception);
        }
    }

    /**
     * @return void
     */
    public function testExpandWithoutOrderBudget(): void
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
            ->willReturn($this->companyUserTransferMock);

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
            ->willThrowException(new RequiredTransferPropertyException());

        $this->orderBudgetTransferMock->expects(static::never())
            ->method('getBudget');

        $this->quoteTransferMock->expects(static::never())
            ->method('requireTotals');

        $this->quoteTransferMock->expects(static::never())
            ->method('getTotals');

        try {
            $this->quoteValidator->validate($this->quoteTransferMock);
            static::fail();
        } catch (Exception $exception) {
            static::assertInstanceOf(RequiredTransferPropertyException::class, $exception);
        }
    }

    /**
     * @return void
     */
    public function testExpandWithoutCompanyBusinessUnit(): void
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
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUser')
            ->willReturn($idCompanyUser);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(AlterCartWithoutLimitPermissionPlugin::KEY, $idCompanyUser)
            ->willReturn(false);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('requireCompanyBusinessUnit')
            ->willThrowException(new RequiredTransferPropertyException());

        $this->companyUserTransferMock->expects(static::never())
            ->method('getCompanyBusinessUnit');

        $this->quoteTransferMock->expects(static::never())
            ->method('requireTotals');

        $this->quoteTransferMock->expects(static::never())
            ->method('getTotals');

        try {
            $this->quoteValidator->validate($this->quoteTransferMock);
            static::fail();
        } catch (Exception $exception) {
            static::assertInstanceOf(RequiredTransferPropertyException::class, $exception);
        }
    }

    /**
     * @return void
     */
    public function testExpandWithoutCompanyUser(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('requireCompanyUser')
            ->willThrowException(new RequiredTransferPropertyException());

        $this->quoteTransferMock->expects(static::never())
            ->method('getCompanyUser');

        $this->permissionFacadeMock->expects(static::never())
            ->method('can');

        $this->quoteTransferMock->expects(static::never())
            ->method('requireTotals');

        $this->quoteTransferMock->expects(static::never())
            ->method('getTotals');

        try {
            $this->quoteValidator->validate($this->quoteTransferMock);
            static::fail();
        } catch (Exception $exception) {
            static::assertInstanceOf(RequiredTransferPropertyException::class, $exception);
        }
    }
}
