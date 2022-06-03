<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Persistence;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishCreditMemoTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery;
use Propel\Runtime\Collection\ObjectCollection;

class JellyfishCreditMemoRepositoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fooCreditMemoQueryMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishCreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishCreditMemoTransferMock;

    /**
     * @var \Propel\Runtime\Collection\ObjectCollection|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $objectCollectionMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoRepositoryInterface
     */
    protected $repository;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(JellyfishCreditMemoPersistenceFactory::class)->disableOriginalConstructor()->getMock();
        $this->objectCollectionMock = $this->getMockBuilder(ObjectCollection::class)->disableOriginalConstructor()->getMock();
        $this->fooCreditMemoQueryMock = $this->getMockBuilder(FooCreditMemoQuery::class)->disableOriginalConstructor()->getMock();
        $this->jellyfishCreditMemoTransferMock = $this->getMockBuilder(JellyfishCreditMemoTransfer::class)->disableOriginalConstructor()->getMock();

        $this->repository = new JellyfishCreditMemoRepository();
        $this->repository->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindPendingCreditMemoCollection(): void
    {
        $this->markTestIncomplete('fix later when its possible to test orm');
        $this->factoryMock->expects(static::once())->method('createCreditMemoQuery')->willReturn($this->fooCreditMemoQueryMock);
        $this->fooCreditMemoQueryMock->expects(static::once())->method('leftJoinWithFooCreditMemoItem')->willReturnSelf();
        $this->fooCreditMemoQueryMock->expects(static::once())->method('leftJoinWithSpyLocale')->willReturnSelf();
        $this->fooCreditMemoQueryMock->expects(static::once())->method('filterByJellyfishExportState')->willReturnSelf();
        $this->fooCreditMemoQueryMock->expects(static::once())->method('find')->willReturn($this->objectCollectionMock);
        $this->jellyfishCreditMemoTransferMock->expects(static::once())->method('getId')->willReturn(1);

        $this->repository->findPendingCreditMemoCollection();
    }
}
