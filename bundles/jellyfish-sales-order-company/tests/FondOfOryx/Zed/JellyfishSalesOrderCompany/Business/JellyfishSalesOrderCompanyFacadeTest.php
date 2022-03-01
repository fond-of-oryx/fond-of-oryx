<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Expander\JellyfishOrderExpanderInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishSalesOrderCompanyFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\JellyfishSalesOrderCompanyBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Expander\JellyfishOrderExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderExpanderMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\JellyfishSalesOrderCompanyFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(JellyfishSalesOrderCompanyBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderExpanderMock = $this->getMockBuilder(JellyfishOrderExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new JellyfishSalesOrderCompanyFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandJellyfishOrder(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createJellyfishOrderExpander')
            ->willReturn($this->jellyfishOrderExpanderMock);

        $this->jellyfishOrderExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            )->willReturn($this->jellyfishOrderTransferMock);

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->facade->expandJellyfishOrder($this->jellyfishOrderTransferMock, $this->spySalesOrderMock),
        );
    }
}
