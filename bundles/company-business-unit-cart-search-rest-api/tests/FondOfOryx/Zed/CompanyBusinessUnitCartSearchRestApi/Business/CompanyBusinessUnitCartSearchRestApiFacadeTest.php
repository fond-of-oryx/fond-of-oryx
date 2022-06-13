<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Expander\QueryJoinCollectionExpanderInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;

class CompanyBusinessUnitCartSearchRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\CompanyBusinessUnitCartSearchRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\CompanyBusinessUnitCartSearchRestApiFacade
     */
    protected $facade;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Expander\QueryJoinCollectionExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryJoinCollectionExpanderMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $filterFieldTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\QueryJoinCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryJoinCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyBusinessUnitCartSearchRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryJoinCollectionExpanderMock = $this->getMockBuilder(QueryJoinCollectionExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyBusinessUnitCartSearchRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandQueryJoinCollection(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createQueryJoinCollectionExpander')
            ->willReturn($this->queryJoinCollectionExpanderMock);

        $this->queryJoinCollectionExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->filterFieldTransferMocks, $this->queryJoinCollectionTransferMock)
            ->willReturn($this->queryJoinCollectionTransferMock);

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->facade->expandQueryJoinCollection(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }
}
