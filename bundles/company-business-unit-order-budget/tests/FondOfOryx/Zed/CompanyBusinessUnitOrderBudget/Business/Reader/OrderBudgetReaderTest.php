<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class OrderBudgetReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reader\OrderBudgetReader
     */
    protected $orderBudgetReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetReader = new OrderBudgetReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetIdOrderBudgetByCompanyBusinessUnit(): void
    {
        $idCompanyBusinessUnit = 1;
        $idOrderBudget = 1;

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($idCompanyBusinessUnit);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdOrderBudgetByIdCompanyBusinessUnit')
            ->with($idCompanyBusinessUnit)
            ->willReturn($idOrderBudget);

        static::assertEquals(
            $idOrderBudget,
            $this->orderBudgetReader->getIdOrderBudgetByCompanyBusinessUnit($this->companyBusinessUnitTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetIdOrderBudgetByCompanyBusinessUnitWithInvalidData(): void
    {
        $idCompanyBusinessUnit = null;

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($idCompanyBusinessUnit);

        $this->repositoryMock->expects(static::never())
            ->method('getIdOrderBudgetByIdCompanyBusinessUnit');

        static::assertEquals(
            null,
            $this->orderBudgetReader->getIdOrderBudgetByCompanyBusinessUnit($this->companyBusinessUnitTransferMock),
        );
    }
}
