<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyProductListSearchRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\CompanyProductListSearchRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyProductListSearchRestApiBusinessFactory|MockObject $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface
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
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\CompanyProductListSearchRestApiFacade
     */
    protected CompanyProductListSearchRestApiFacade $facade;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyProductListSearchRestApiBusinessFactory::class)
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

        $this->facade = new CompanyProductListSearchRestApiFacade();
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
