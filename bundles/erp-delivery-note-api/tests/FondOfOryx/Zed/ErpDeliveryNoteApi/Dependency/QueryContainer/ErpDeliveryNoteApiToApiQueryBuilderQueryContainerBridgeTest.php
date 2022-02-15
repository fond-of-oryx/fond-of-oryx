<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderCriteriaTransfer;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface;

class ErpDeliveryNoteApiToApiQueryBuilderQueryContainerBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface
     */
    protected $apiQueryBuilderQueryContainerInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer
     */
    protected $apiQueryBuilderQueryTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PropelQueryBuilderCriteriaTransfer
     */
    protected $propelQueryBuilderCriteriaTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected $modelCriteriaMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\QueryContainer\ErpDeliveryNoteApiToApiQueryBuilderQueryContainerBridge
     */
    protected $erpDeliveryNoteApiToApiQueryBuilderQueryContainerBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiQueryBuilderQueryContainerInterfaceMock = $this->getMockBuilder(ApiQueryBuilderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryBuilderQueryTransferMock = $this->getMockBuilder(ApiQueryBuilderQueryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->propelQueryBuilderCriteriaTransferMock = $this->getMockBuilder(PropelQueryBuilderCriteriaTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->modelCriteriaMock = $this->getMockBuilder(ModelCriteria::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteApiToApiQueryBuilderQueryContainerBridge = new ErpDeliveryNoteApiToApiQueryBuilderQueryContainerBridge(
            $this->apiQueryBuilderQueryContainerInterfaceMock,
        );
    }

    /**
     * @return void
     */
    public function testToPropelQueryBuilderCriteria(): void
    {
        $this->apiQueryBuilderQueryContainerInterfaceMock->expects(static::atLeastOnce())
            ->method('toPropelQueryBuilderCriteria')
            ->with($this->apiQueryBuilderQueryTransferMock)
            ->willReturn($this->propelQueryBuilderCriteriaTransferMock);

        static::assertEquals(
            $this->propelQueryBuilderCriteriaTransferMock,
            $this->erpDeliveryNoteApiToApiQueryBuilderQueryContainerBridge->toPropelQueryBuilderCriteria(
                $this->apiQueryBuilderQueryTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testBuildQueryFromRequest(): void
    {
        $this->apiQueryBuilderQueryContainerInterfaceMock->expects(static::atLeastOnce())
            ->method('buildQueryFromRequest')
            ->with($this->modelCriteriaMock, $this->apiQueryBuilderQueryTransferMock)
            ->willReturn($this->modelCriteriaMock);

        static::assertEquals(
            $this->modelCriteriaMock,
            $this->erpDeliveryNoteApiToApiQueryBuilderQueryContainerBridge->buildQueryFromRequest(
                $this->modelCriteriaMock,
                $this->apiQueryBuilderQueryTransferMock,
            ),
        );
    }
}
