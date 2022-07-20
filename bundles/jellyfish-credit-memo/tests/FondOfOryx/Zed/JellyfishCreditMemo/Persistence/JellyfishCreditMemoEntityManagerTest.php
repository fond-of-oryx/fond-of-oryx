<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Persistence;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishCreditMemoTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery;

class JellyfishCreditMemoEntityManagerTest extends Unit
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
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoEntityManagerInterface
     */
    protected $em;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(JellyfishCreditMemoPersistenceFactory::class)->disableOriginalConstructor()->getMock();
        $this->fooCreditMemoQueryMock = $this->getMockBuilder(FooCreditMemoQuery::class)->disableOriginalConstructor()->getMock();
        $this->jellyfishCreditMemoTransferMock = $this->getMockBuilder(JellyfishCreditMemoTransfer::class)->disableOriginalConstructor()->getMock();

        $this->em = new class ($this->factoryMock) extends JellyfishCreditMemoEntityManager {
            /**
             * @var \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoPersistenceFactory
             */
            protected $ownFactory;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoPersistenceFactory $factory
             */
            public function __construct(JellyfishCreditMemoPersistenceFactory $factory)
            {
                $this->ownFactory = $factory;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\PersistenceFactoryInterface
             */
            protected function getFactory()
            {
                return $this->ownFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testUpdateExportState(): void
    {
        $this->factoryMock->expects(static::once())->method('createCreditMemoQuery')->willReturn($this->fooCreditMemoQueryMock);
        $this->fooCreditMemoQueryMock->expects(static::once())->method('filterByIdCreditMemo')->willReturnSelf();
        $this->fooCreditMemoQueryMock->expects(static::once())->method('update')->willReturn(1);
        $this->jellyfishCreditMemoTransferMock->expects(static::once())->method('getId')->willReturn(1);

        $this->em->updateExportState($this->jellyfishCreditMemoTransferMock);
    }
}
