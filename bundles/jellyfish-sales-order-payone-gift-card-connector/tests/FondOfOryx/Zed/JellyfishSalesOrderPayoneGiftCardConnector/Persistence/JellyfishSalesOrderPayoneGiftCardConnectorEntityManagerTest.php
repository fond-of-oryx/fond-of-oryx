<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\Propel\Mapper\ProportionalGiftCardValueMapperInterface;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue;
use Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValueQuery;

class JellyfishSalesOrderPayoneGiftCardConnectorEntityManagerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\Propel\Mapper\ProportionalGiftCardValueMapperInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $mapperMock;

    /**
     * @var \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $propotionalGiftCardValueTransferMock;

    /**
     * @var \Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $entityMock;

    /**
     * @var \Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValueQuery|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $queryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->propotionalGiftCardValueTransferMock = $this
            ->getMockBuilder(ProportionalGiftCardValueTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityMock = $this
            ->getMockBuilder(FooProportionalGiftCardValue::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapperMock = $this
            ->getMockBuilder(ProportionalGiftCardValueMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryMock = $this
            ->getMockBuilder(FooProportionalGiftCardValueQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManager = new JellyfishSalesOrderPayoneGiftCardConnectorEntityManager();
        $this->entityManager->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindOrCreateProportionalGiftCardValue(): void
    {
        $fkSalesOrder = 1;
        $fkSalesOrderItem = 1;
        $fkSalesExpense = 1;

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('getFkSalesOrder')
            ->willReturn($fkSalesOrder);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('getFkSalesOrderItem')
            ->willReturn($fkSalesOrderItem);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('getFkSalesExpense')
            ->willReturn($fkSalesExpense);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProportionalGiftCardValueMapper')
            ->willReturn($this->mapperMock);

        $this->mapperMock->expects(static::atLeastOnce())
            ->method('mapTransferToEntity')
            ->with(
                $this->propotionalGiftCardValueTransferMock,
                $this->entityMock,
            )
            ->willReturn($this->entityMock);

        $this->entityMock->expects(static::atLeastOnce())
            ->method('save')
            ->willReturn(1);

        $this->mapperMock->expects(static::atLeastOnce())
            ->method('mapEntityToTransfer')
            ->with($this->entityMock)
            ->willReturn($this->propotionalGiftCardValueTransferMock);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProportionalGiftCardValueQuery')
            ->willReturn($this->queryMock);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('filterByFkSalesOrder')
            ->with($fkSalesOrder)
            ->willReturn($this->queryMock);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('filterByFkSalesExpense')
            ->with($fkSalesExpense)
            ->willReturn($this->queryMock);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('filterByFkSalesOrderItem')
            ->with($fkSalesOrderItem)
            ->willReturn($this->queryMock);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('findOneOrCreate')
            ->willReturn($this->entityMock);

        static::assertInstanceOf(
            ProportionalGiftCardValueTransfer::class,
            $this->entityManager->findOrCreateProportionalGiftCardValue($this->propotionalGiftCardValueTransferMock),
        );
    }
}
