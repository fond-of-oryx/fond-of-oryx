<?php

namespace FondOfOryx\Zed\ErpInvoice\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAddressHandler;
use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAmountHandler;
use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceItemHandler;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReader;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceWriter;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManager;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepository;
use Generated\Shared\Transfer\ErpInvoiceResponseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceBusinessFactoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceReaderMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAddressHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceAddressHandlerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAmountHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTotalHandlerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceItemHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceItemHandlerMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacade
     */
    protected $erpInvoiceFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(ErpInvoiceEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ErpInvoiceRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceTransferMock = $this->getMockBuilder(ErpInvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceResponseTransferMock = $this->getMockBuilder(ErpInvoiceResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceWriterMock = $this->getMockBuilder(ErpInvoiceWriter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceReaderMock = $this->getMockBuilder(ErpInvoiceReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceAddressHandlerMock = $this->getMockBuilder(ErpInvoiceAddressHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceTotalHandlerMock = $this->getMockBuilder(ErpInvoiceAmountHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceItemHandlerMock = $this->getMockBuilder(ErpInvoiceItemHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceBusinessFactoryMock = $this->getMockBuilder(ErpInvoiceBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceFacade = new ErpInvoiceFacade();
        $this->erpInvoiceFacade->setFactory($this->erpInvoiceBusinessFactoryMock);
        $this->erpInvoiceFacade->setEntityManager($this->entityManagerMock);
        $this->erpInvoiceFacade->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateErpInvoice(): void
    {
        $this->erpInvoiceBusinessFactoryMock->expects($this->once())->method('createErpInvoiceWriter')->willReturn($this->erpInvoiceWriterMock);
        $this->erpInvoiceWriterMock->expects($this->once())->method('create')->willReturn($this->erpInvoiceResponseTransferMock);

        $this->erpInvoiceFacade->createErpInvoice($this->erpInvoiceTransferMock);
    }

    /**
     * @return void
     */
    public function testUpdateErpInvoice(): void
    {
        $this->erpInvoiceBusinessFactoryMock->expects($this->once())->method('createErpInvoiceWriter')->willReturn($this->erpInvoiceWriterMock);
        $this->erpInvoiceWriterMock->expects($this->once())->method('update')->willReturn($this->erpInvoiceResponseTransferMock);

        $this->erpInvoiceFacade->updateErpInvoice($this->erpInvoiceTransferMock);
    }

    /**
     * @return void
     */
    public function testDeleteErpInvoiceByIdErpInvoice(): void
    {
        $this->erpInvoiceBusinessFactoryMock->expects($this->once())->method('createErpInvoiceWriter')->willReturn($this->erpInvoiceWriterMock);
        $this->erpInvoiceWriterMock->expects($this->once())->method('delete');

        $this->erpInvoiceFacade->deleteErpInvoiceByIdErpInvoice(1);
    }

    /**
     * @return void
     */
    public function testFindErpInvoiceByIdErpInvoice(): void
    {
        $this->erpInvoiceBusinessFactoryMock->expects($this->once())->method('createErpInvoiceReader')->willReturn($this->erpInvoiceReaderMock);
        $this->erpInvoiceReaderMock->expects($this->once())->method('findErpInvoiceByIdErpInvoice');

        $this->erpInvoiceFacade->findErpInvoiceByIdErpInvoice(1);
    }

    /**
     * @return void
     */
    public function testPersistBillingAddress(): void
    {
        $self = $this;
        $this->erpInvoiceBusinessFactoryMock->expects($this->once())->method('createErpInvoiceAddressHandler')->willReturn($this->erpInvoiceAddressHandlerMock);
        $this->erpInvoiceAddressHandlerMock->expects($this->once())->method('handle')->will($this->returnCallback(static function ($a, $b) use ($self) {
            $self->assertSame('billingAddress', $b);

            return $a;
        }));

        $this->erpInvoiceFacade->persistBillingAddress($this->erpInvoiceTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistShippingAddress(): void
    {
        $self = $this;
        $this->erpInvoiceBusinessFactoryMock->expects($this->once())->method('createErpInvoiceAddressHandler')->willReturn($this->erpInvoiceAddressHandlerMock);
        $this->erpInvoiceAddressHandlerMock->expects($this->once())->method('handle')->will($this->returnCallback(static function ($a, $b) use ($self) {
            $self->assertSame('shippingAddress', $b);

            return $a;
        }));

        $this->erpInvoiceFacade->persistShippingAddress($this->erpInvoiceTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistErpInvoiceAmount(): void
    {
        $self = $this;
        $this->erpInvoiceBusinessFactoryMock->expects($this->once())
            ->method('createErpInvoiceAmountHandler')
            ->willReturn($this->erpInvoiceTotalHandlerMock);

        $this->erpInvoiceTotalHandlerMock->expects($this->once())
            ->method('handle')
            ->with($this->erpInvoiceTransferMock)
            ->willReturn($this->erpInvoiceTransferMock);

        $erpInvoiceTransfer = $this->erpInvoiceFacade->persistErpInvoiceAmount($this->erpInvoiceTransferMock);

        $this->assertInstanceOf(
            ErpInvoiceTransfer::class,
            $erpInvoiceTransfer,
        );
    }
}
