<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchPersistenceFactory;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchRepository;
use Generated\Shared\Transfer\FilterTransfer;
use Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearchQuery;

class ErpOrderPageSearchRepositoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FilterTransfer
     */
    protected $filterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FooErpOrderPageSearchEntityTransfer
     */
    protected $erpOrderPageSearchPersistenceFactoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchRepositoryInterface
     */
    protected $erpOrderPageSearchRepository;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearchQuery
     */
    protected $fooErpOrderPageSearchQuery;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->filterTransferMock = $this->getMockBuilder(FilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchPersistenceFactoryMock = $this->getMockBuilder(ErpOrderPageSearchPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fooErpOrderPageSearchQuery = $this->getMockBuilder(FooErpOrderPageSearchQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchRepository = new ErpOrderPageSearchRepository();
        $this->erpOrderPageSearchRepository->setFactory($this->erpOrderPageSearchPersistenceFactoryMock);
    }

    /**
     * @return void
     */
    public function testFindFilteredErpOrderPageSearchEntities(): void
    {
        /*$erpOrderIds = [1];

        $this->erpOrderPageSearchPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('getErpOrderPageSearchQuery')
            ->willReturn($this->fooErpOrderPageSearchQuery);

        $this->fooErpOrderPageSearchQuery->expects(static::atLeastOnce())
            ->method('filterByFkErpOrder_In')
            ->willReturn($this->fooErpOrderPageSearchQuery);

        $searchEntities = $this->erpOrderPageSearchRepository->findFilteredErpOrderPageSearchEntities(
            $this->filterTransferMock,
            $erpOrderIds
        );


        $this->assertIsArray($searchEntities);*/
    }
}
