<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteAddressHandler;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteItemHandler;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteReader;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteWriter;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManager;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepository;
use Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteBusinessFactoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteReaderMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteAddressHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteAddressHandlerMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteItemHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteItemHandlerMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacade
     */
    protected $erpDeliveryNoteFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(ErpDeliveryNoteEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ErpDeliveryNoteRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteTransferMock = $this->getMockBuilder(ErpDeliveryNoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteResponseTransferMock = $this->getMockBuilder(ErpDeliveryNoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteWriterMock = $this->getMockBuilder(ErpDeliveryNoteWriter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteReaderMock = $this->getMockBuilder(ErpDeliveryNoteReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteAddressHandlerMock = $this->getMockBuilder(ErpDeliveryNoteAddressHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteItemHandlerMock = $this->getMockBuilder(ErpDeliveryNoteItemHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteBusinessFactoryMock = $this->getMockBuilder(ErpDeliveryNoteBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteFacade = new ErpDeliveryNoteFacade();
        $this->erpDeliveryNoteFacade->setFactory($this->erpDeliveryNoteBusinessFactoryMock);
        $this->erpDeliveryNoteFacade->setEntityManager($this->entityManagerMock);
        $this->erpDeliveryNoteFacade->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateErpDeliveryNote(): void
    {
        $this->erpDeliveryNoteBusinessFactoryMock->expects($this->once())->method('createErpDeliveryNoteWriter')->willReturn($this->erpDeliveryNoteWriterMock);
        $this->erpDeliveryNoteWriterMock->expects($this->once())->method('create')->willReturn($this->erpDeliveryNoteResponseTransferMock);

        $this->erpDeliveryNoteFacade->createErpDeliveryNote($this->erpDeliveryNoteTransferMock);
    }

    /**
     * @return void
     */
    public function testUpdateErpDeliveryNote(): void
    {
        $this->erpDeliveryNoteBusinessFactoryMock->expects($this->once())->method('createErpDeliveryNoteWriter')->willReturn($this->erpDeliveryNoteWriterMock);
        $this->erpDeliveryNoteWriterMock->expects($this->once())->method('update')->willReturn($this->erpDeliveryNoteResponseTransferMock);

        $this->erpDeliveryNoteFacade->updateErpDeliveryNote($this->erpDeliveryNoteTransferMock);
    }

    /**
     * @return void
     */
    public function testDeleteErpDeliveryNoteByIdErpDeliveryNote(): void
    {
        $this->erpDeliveryNoteBusinessFactoryMock->expects($this->once())->method('createErpDeliveryNoteWriter')->willReturn($this->erpDeliveryNoteWriterMock);
        $this->erpDeliveryNoteWriterMock->expects($this->once())->method('delete');

        $this->erpDeliveryNoteFacade->deleteErpDeliveryNoteByIdErpDeliveryNote(1);
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNoteByIdErpDeliveryNote(): void
    {
        $this->erpDeliveryNoteBusinessFactoryMock->expects($this->once())->method('createErpDeliveryNoteReader')->willReturn($this->erpDeliveryNoteReaderMock);
        $this->erpDeliveryNoteReaderMock->expects($this->once())->method('findErpDeliveryNoteByIdErpDeliveryNote');

        $this->erpDeliveryNoteFacade->findErpDeliveryNoteByIdErpDeliveryNote(1);
    }

    /**
     * @return void
     */
    public function testPersistBillingAddress(): void
    {
        $self = $this;
        $this->erpDeliveryNoteBusinessFactoryMock->expects($this->once())->method('createErpDeliveryNoteAddressHandler')->willReturn($this->erpDeliveryNoteAddressHandlerMock);
        $this->erpDeliveryNoteAddressHandlerMock->expects($this->once())->method('handle')->will($this->returnCallback(static function ($a, $b) use ($self) {
            $self->assertSame('billingAddress', $b);

            return $a;
        }));

        $this->erpDeliveryNoteFacade->persistBillingAddress($this->erpDeliveryNoteTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistShippingAddress(): void
    {
        $self = $this;
        $this->erpDeliveryNoteBusinessFactoryMock->expects($this->once())->method('createErpDeliveryNoteAddressHandler')->willReturn($this->erpDeliveryNoteAddressHandlerMock);
        $this->erpDeliveryNoteAddressHandlerMock->expects($this->once())->method('handle')->will($this->returnCallback(static function ($a, $b) use ($self) {
            $self->assertSame('shippingAddress', $b);

            return $a;
        }));

        $this->erpDeliveryNoteFacade->persistShippingAddress($this->erpDeliveryNoteTransferMock);
    }
}
