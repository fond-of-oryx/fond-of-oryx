<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Model\ErpDeliveryNoteApiInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Validator\ErpDeliveryNoteApiValidatorInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpDeliveryNoteApiFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Model\ErpDeliveryNoteApi|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteApiMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Validator\ErpDeliveryNoteApiValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteApiValidatorMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\ErpDeliveryNoteApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteApiBusinessFactoryMock;

    /**
     * @var int
     */
    protected $idErpDeliveryNote;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\ErpDeliveryNoteApiFacade
     */
    protected $erpDeliveryNoteApiFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteApiMock = $this->getMockBuilder(ErpDeliveryNoteApiInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteApiValidatorMock = $this->getMockBuilder(ErpDeliveryNoteApiValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteApiBusinessFactoryMock = $this->getMockBuilder(ErpDeliveryNoteApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idErpDeliveryNote = 1;

        $this->erpDeliveryNoteApiFacade = new ErpDeliveryNoteApiFacade();
        $this->erpDeliveryNoteApiFacade->setFactory($this->erpDeliveryNoteApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testCreateErpDeliveryNote(): void
    {
        $this->erpDeliveryNoteApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNoteApi')
            ->willReturn($this->erpDeliveryNoteApiMock);

        $this->erpDeliveryNoteApiMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApiFacade->createErpDeliveryNote($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateErpDeliveryNote(): void
    {
        $this->erpDeliveryNoteApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNoteApi')
            ->willReturn($this->erpDeliveryNoteApiMock);

        $this->erpDeliveryNoteApiMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->idErpDeliveryNote, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApiFacade->updateErpDeliveryNote($this->idErpDeliveryNote, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetErpDeliveryNote(): void
    {
        $this->erpDeliveryNoteApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNoteApi')
            ->willReturn($this->erpDeliveryNoteApiMock);

        $this->erpDeliveryNoteApiMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($this->idErpDeliveryNote)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApiFacade->getErpDeliveryNote($this->idErpDeliveryNote),
        );
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNotes(): void
    {
        $this->erpDeliveryNoteApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNoteApi')
            ->willReturn($this->erpDeliveryNoteApiMock);

        $this->erpDeliveryNoteApiMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->erpDeliveryNoteApiFacade->findErpDeliveryNotes($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testDeleteErpDeliveryNote(): void
    {
        $this->erpDeliveryNoteApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNoteApi')
            ->willReturn($this->erpDeliveryNoteApiMock);

        $this->erpDeliveryNoteApiMock->expects(static::atLeastOnce())
            ->method('delete')
            ->with($this->idErpDeliveryNote)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApiFacade->deleteErpDeliveryNote($this->idErpDeliveryNote),
        );
    }

    /**
     * @return void
     */
    public function testValidateErpDeliveryNote(): void
    {
        $validationResult = [];

        $this->erpDeliveryNoteApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNoteApiValidator')
            ->willReturn($this->erpDeliveryNoteApiValidatorMock);

        $this->erpDeliveryNoteApiValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn($validationResult);

        static::assertEquals(
            $validationResult,
            $this->erpDeliveryNoteApiFacade->validateErpDeliveryNote($this->apiDataTransferMock),
        );
    }
}
