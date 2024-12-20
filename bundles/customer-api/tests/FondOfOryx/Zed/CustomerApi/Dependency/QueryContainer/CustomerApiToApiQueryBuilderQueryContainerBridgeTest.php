<?php

namespace FondOfOryx\Zed\CustomerApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderCriteriaTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface;

class CustomerApiToApiQueryBuilderQueryContainerBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiQueryBuilderQueryContainerInterface|MockObject $queryContainer;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer
     */
    protected MockObject|ApiQueryBuilderQueryTransfer $apiQueryBuilderQueryTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PropelQueryBuilderCriteriaTransfer
     */
    protected MockObject|PropelQueryBuilderCriteriaTransfer $propelQueryBuilderCriteriaTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected MockObject|ModelCriteria $modelCriteriaMock;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Dependency\QueryContainer\CustomerApiToApiQueryBuilderQueryContainerBridge
     */
    protected CustomerApiToApiQueryBuilderQueryContainerBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->queryContainer = $this->getMockBuilder(ApiQueryBuilderQueryContainerInterface::class)
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

        $this->bridge = new CustomerApiToApiQueryBuilderQueryContainerBridge(
            $this->queryContainer,
        );
    }

    /**
     * @return void
     */
    public function testToPropelQueryBuilderCriteria(): void
    {
        $this->queryContainer->expects(static::atLeastOnce())
            ->method('toPropelQueryBuilderCriteria')
            ->with($this->apiQueryBuilderQueryTransferMock)
            ->willReturn($this->propelQueryBuilderCriteriaTransferMock);

        static::assertEquals(
            $this->propelQueryBuilderCriteriaTransferMock,
            $this->bridge->toPropelQueryBuilderCriteria(
                $this->apiQueryBuilderQueryTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testBuilderQueryFromRequest(): void
    {
        $this->queryContainer->expects(static::atLeastOnce())
            ->method('buildQueryFromRequest')
            ->with(
                $this->modelCriteriaMock,
                $this->apiQueryBuilderQueryTransferMock,
            )->willReturn($this->modelCriteriaMock);

        static::assertEquals(
            $this->modelCriteriaMock,
            $this->bridge->buildQueryFromRequest(
                $this->modelCriteriaMock,
                $this->apiQueryBuilderQueryTransferMock,
            ),
        );
    }
}
