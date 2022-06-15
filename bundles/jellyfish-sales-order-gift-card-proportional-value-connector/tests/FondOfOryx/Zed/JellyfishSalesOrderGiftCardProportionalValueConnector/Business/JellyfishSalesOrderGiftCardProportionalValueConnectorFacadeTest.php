<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper\GiftCardProportionalValueMapper;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishSalesOrderGiftCardProportionalValueConnectorFacadeTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\JellyfishSalesOrderGiftCardProportionalValueConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper\ProportionalValueMapperInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $giftCardProportionalValueMapperMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\JellyfishSalesOrderGiftCardProportionalValueConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->spySalesOrderMock =
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->factoryMock =
            $this->getMockBuilder(JellyfishSalesOrderGiftCardProportionalValueConnectorBusinessFactory::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->giftCardProportionalValueMapperMock =
            $this->getMockBuilder(GiftCardProportionalValueMapper::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->jellyfishOrderTransferMock =
            $this->getMockBuilder(JellyfishOrderTransfer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->facade = new JellyfishSalesOrderGiftCardProportionalValueConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testMapProportionalGiftCardValues(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardProportionalValueMapper')
            ->willReturn($this->giftCardProportionalValueMapperMock);

        $this->giftCardProportionalValueMapperMock->expects(static::atLeastOnce())
            ->method('fromSalesOrderToJellyfishOrder')
            ->willReturn($this->jellyfishOrderTransferMock);

        $this->facade->mapProportionalGiftCardValues($this->jellyfishOrderTransferMock, $this->spySalesOrderMock);
    }
}
