<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainer;

class ThirtyFiveUpApiToApiQueryBuilderContainerBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerBridge
     */
    protected $bridge;

    /**
     * @var \Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryBuilderMock;

    /**
     * @var \Propel\Runtime\ActiveQuery\ModelCriteria|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $modelCriteriaMock;

    /**
     * @var \Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiQueryBuilderQueryTransfer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->queryBuilderMock = $this->getMockBuilder(ApiQueryBuilderQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->modelCriteriaMock = $this->getMockBuilder(ModelCriteria::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryBuilderQueryTransfer = $this->getMockBuilder(ApiQueryBuilderQueryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ThirtyFiveUpApiToApiQueryBuilderContainerBridge(
            $this->queryBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testUpdateThirtyFiveUpOrder(): void
    {
        $this->queryBuilderMock->expects($this->once())
            ->method('buildQueryFromRequest')
            ->willReturn($this->modelCriteriaMock);

        $this->bridge->buildQueryFromRequest($this->modelCriteriaMock, $this->apiQueryBuilderQueryTransfer);
    }
}
