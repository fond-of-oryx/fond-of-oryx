<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\Writer\OrderBudgetWriterInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class OrderBudgetCompanyBusinessUnitConnectorFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\OrderBudgetCompanyBusinessUnitConnectorBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\OrderBudgetCompanyBusinessUnitConnectorBusinessFactory
     */
    protected $orderBudgetWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\OrderBudgetCompanyBusinessUnitConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(OrderBudgetCompanyBusinessUnitConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetWriterMock = $this->getMockBuilder(OrderBudgetWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new OrderBudgetCompanyBusinessUnitConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testCreateOrderBudgetForCompanyBusinessUnit(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createOrderBudgetWriter')
            ->willReturn($this->orderBudgetWriterMock);

        $this->orderBudgetWriterMock->expects(static::atLeastOnce())
            ->method('createForCompanyBusinessUnit')
            ->with($this->companyBusinessUnitTransferMock);

        $this->facade->createOrderBudgetForCompanyBusinessUnit($this->companyBusinessUnitTransferMock);
    }
}
