<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CustomerProductListSearchRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\CustomerProductListSearchRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerProductListSearchRestApiBusinessFactory|MockObject $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface
     */
    protected MockObject|SearchProductListQueryExpanderInterface $searchProductListQueryExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\CustomerProductListSearchRestApiFacade
     */
    protected CustomerProductListSearchRestApiFacade $facade;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CustomerProductListSearchRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchProductListQueryExpanderMock = $this->getMockBuilder(SearchProductListQueryExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->facade = new CustomerProductListSearchRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandSearchProductListQuery(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createSearchProductListQueryExpander')
            ->willReturn($this->searchProductListQueryExpanderMock);

        $this->searchProductListQueryExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->filterFieldTransferMocks, $this->queryJoinCollectionTransferMock)
            ->willReturn($this->queryJoinCollectionTransferMock);

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->facade->expandSearchProductListQuery(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }
}
