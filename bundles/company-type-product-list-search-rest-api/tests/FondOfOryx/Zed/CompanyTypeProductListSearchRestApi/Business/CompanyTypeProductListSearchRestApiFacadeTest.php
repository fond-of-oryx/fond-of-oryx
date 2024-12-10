<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyTypeProductListSearchRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\CompanyTypeProductListSearchRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyTypeProductListSearchRestApiBusinessFactory|MockObject $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface
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
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\CompanyTypeProductListSearchRestApiFacade
     */
    protected CompanyTypeProductListSearchRestApiFacade $facade;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyTypeProductListSearchRestApiBusinessFactory::class)
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

        $this->facade = new CompanyTypeProductListSearchRestApiFacade();
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
