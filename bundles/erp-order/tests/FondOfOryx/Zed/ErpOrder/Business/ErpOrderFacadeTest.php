<?php

namespace FondOfOryx\Zed\ErpOrder\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderAddressHandler;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderItemHandler;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderTotalHandler;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderReader;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderWriter;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManager;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepository;
use Generated\Shared\Transfer\ErpOrderResponseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\ErpOrderBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderBusinessFactoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderReaderMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderAddressHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderAddressHandlerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderTotalHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalHandlerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderItemHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderItemHandlerMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacade
     */
    protected $erpOrderFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(ErpOrderEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ErpOrderRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTransferMock = $this->getMockBuilder(ErpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderResponseTransferMock = $this->getMockBuilder(ErpOrderResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderWriterMock = $this->getMockBuilder(ErpOrderWriter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderReaderMock = $this->getMockBuilder(ErpOrderReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderAddressHandlerMock = $this->getMockBuilder(ErpOrderAddressHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTotalHandlerMock = $this->getMockBuilder(ErpOrderTotalHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderItemHandlerMock = $this->getMockBuilder(ErpOrderItemHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderBusinessFactoryMock = $this->getMockBuilder(ErpOrderBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderFacade = new ErpOrderFacade();
        $this->erpOrderFacade->setFactory($this->erpOrderBusinessFactoryMock);
        $this->erpOrderFacade->setEntityManager($this->entityManagerMock);
        $this->erpOrderFacade->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateErpOrder(): void
    {
        $this->erpOrderBusinessFactoryMock->expects(static::atLeastOnce())->method('createErpOrderWriter')->willReturn($this->erpOrderWriterMock);
        $this->erpOrderWriterMock->expects(static::atLeastOnce())->method('create')->willReturn($this->erpOrderResponseTransferMock);

        $this->erpOrderFacade->createErpOrder($this->erpOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testUpdateErpOrder(): void
    {
        $this->erpOrderBusinessFactoryMock->expects(static::atLeastOnce())->method('createErpOrderWriter')->willReturn($this->erpOrderWriterMock);
        $this->erpOrderWriterMock->expects(static::atLeastOnce())->method('update')->willReturn($this->erpOrderResponseTransferMock);

        $this->erpOrderFacade->updateErpOrder($this->erpOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testDeleteErpOrderByIdErpOrder(): void
    {
        $this->erpOrderBusinessFactoryMock->expects(static::atLeastOnce())->method('createErpOrderWriter')->willReturn($this->erpOrderWriterMock);
        $this->erpOrderWriterMock->expects(static::atLeastOnce())->method('delete');

        $this->erpOrderFacade->deleteErpOrderByIdErpOrder(1);
    }

    /**
     * @return void
     */
    public function testFindErpOrderByIdErpOrder(): void
    {
        $this->erpOrderBusinessFactoryMock->expects(static::atLeastOnce())->method('createErpOrderReader')->willReturn($this->erpOrderReaderMock);
        $this->erpOrderReaderMock->expects(static::atLeastOnce())->method('findErpOrderByIdErpOrder');

        $this->erpOrderFacade->findErpOrderByIdErpOrder(1);
    }

    /**
     * @return void
     */
    public function testPersistBillingAddress(): void
    {
        $self = $this;
        $this->erpOrderBusinessFactoryMock->expects(static::atLeastOnce())->method('createErpOrderAddressHandler')->willReturn($this->erpOrderAddressHandlerMock);
        $this->erpOrderAddressHandlerMock->expects(static::atLeastOnce())->method('handle')->will($this->returnCallback(static function ($a, $b) use ($self) {
            $self->assertSame('billingAddress', $b);

            return $a;
        }));

        $this->erpOrderFacade->persistBillingAddress($this->erpOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistShippingAddress(): void
    {
        $self = $this;
        $this->erpOrderBusinessFactoryMock->expects(static::atLeastOnce())->method('createErpOrderAddressHandler')->willReturn($this->erpOrderAddressHandlerMock);
        $this->erpOrderAddressHandlerMock->expects(static::atLeastOnce())->method('handle')->will($this->returnCallback(static function ($a, $b) use ($self) {
            $self->assertSame('shippingAddress', $b);

            return $a;
        }));

        $this->erpOrderFacade->persistShippingAddress($this->erpOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistErpOrderTotal(): void
    {
        $self = $this;
        $this->erpOrderBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpOrderTotalHandler')
            ->willReturn($this->erpOrderTotalHandlerMock);

        $this->erpOrderTotalHandlerMock->expects(static::atLeastOnce())
            ->method('handle')
            ->with($this->erpOrderTransferMock)
            ->willReturn($this->erpOrderTransferMock);

        $erpOrderTransfer = $this->erpOrderFacade->persistErpOrderTotal($this->erpOrderTransferMock);

        $this->assertInstanceOf(
            ErpOrderTransfer::class,
            $erpOrderTransfer,
        );
    }
}
