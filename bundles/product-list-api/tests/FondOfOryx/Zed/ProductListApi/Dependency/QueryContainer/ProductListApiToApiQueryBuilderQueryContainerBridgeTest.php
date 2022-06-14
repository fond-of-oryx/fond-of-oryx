<?php

namespace FondOfOryx\Zed\ProductListApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderCriteriaTransfer;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface;

class ProductListApiToApiQueryBuilderQueryContainerBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiQueryBuilderQueryContainerMock;

    /**
     * @var \Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiQueryBuilderQueryTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListApi\Dependency\QueryContainer\ProductListApiToApiQueryBuilderQueryContainerInterface
     */
    protected $dependencyApiQueryBuilderQueryContainer;

    /**
     * @var \Propel\Runtime\ActiveQuery\ModelCriteria|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $modelCriteriaMock;

    /**
     * @var \Generated\Shared\Transfer\PropelQueryBuilderCriteriaTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $propelQueryBuilderCriteriaTransfer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiQueryBuilderQueryContainerMock = $this
            ->getMockBuilder(ApiQueryBuilderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryBuilderQueryTransferMock = $this
            ->getMockBuilder(ApiQueryBuilderQueryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->modelCriteriaMock = $this
            ->getMockBuilder(ModelCriteria::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->propelQueryBuilderCriteriaTransfer = $this
            ->getMockBuilder(PropelQueryBuilderCriteriaTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyApiQueryBuilderQueryContainer = new ProductListApiToApiQueryBuilderQueryContainerBridge(
            $this->apiQueryBuilderQueryContainerMock,
        );
    }

    /**
     * @return void
     */
    public function testToPropelQueryBuilderCriteria(): void
    {
        $this->apiQueryBuilderQueryContainerMock->expects(static::atLeastOnce())
            ->method('toPropelQueryBuilderCriteria')
            ->with($this->apiQueryBuilderQueryTransferMock)
            ->willReturn($this->propelQueryBuilderCriteriaTransfer);

        static::assertInstanceOf(
            PropelQueryBuilderCriteriaTransfer::class,
            $this->dependencyApiQueryBuilderQueryContainer
                ->toPropelQueryBuilderCriteria($this->apiQueryBuilderQueryTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testBuildQueryFromRequest(): void
    {
        $this->apiQueryBuilderQueryContainerMock->expects(static::atLeastOnce())
            ->method('buildQueryFromRequest')
            ->with($this->modelCriteriaMock, $this->apiQueryBuilderQueryTransferMock)
            ->willReturn($this->modelCriteriaMock);

        static::assertInstanceOf(
            ModelCriteria::class,
            $this->dependencyApiQueryBuilderQueryContainer->buildQueryFromRequest(
                $this->modelCriteriaMock,
                $this->apiQueryBuilderQueryTransferMock,
            ),
        );
    }
}
