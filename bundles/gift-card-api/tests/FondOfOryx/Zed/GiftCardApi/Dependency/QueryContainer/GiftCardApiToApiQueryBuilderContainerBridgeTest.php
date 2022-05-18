<?php

namespace FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface;

class GiftCardApiToApiQueryBuilderContainerBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryBuilderContainerBridge
     */
    protected $apiQueryBuilderContainerBridge;

    /**
     * @var \Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiQueryBuilderQueryContainerMock;

    /**
     * @var \Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiQueryBuilderQueryTransferMock;

    /**
     * @var \Propel\Runtime\ActiveQuery\ModelCriteria|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $modelCriteriaMock;

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

        $this->apiQueryBuilderQueryTransferMock = $this->getMockBuilder(ApiQueryBuilderQueryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->modelCriteriaMock = $this->getMockBuilder(ModelCriteria::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryBuilderContainerBridge =
            new GiftCardApiToApiQueryBuilderContainerBridge($this->apiQueryBuilderQueryContainerMock);
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
            $this->apiQueryBuilderContainerBridge->buildQueryFromRequest(
                $this->modelCriteriaMock,
                $this->apiQueryBuilderQueryTransferMock,
            ),
        );
    }
}
