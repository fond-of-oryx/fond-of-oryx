<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManager;
use FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueRepository;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

class GiftCardProportionalValueFacadeTest extends Unit
{
    /**
     * @var array<\Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $itemTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $proportionalGiftCardValueTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $entityManagerMocks;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $repositoryMocks;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->proportionalGiftCardValueTransferMock =
            $this->getMockBuilder(ProportionalGiftCardValueTransfer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->entityManagerMocks =
            $this->getMockBuilder(GiftCardProportionalValueEntityManager::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->repositoryMocks =
            $this->getMockBuilder(GiftCardProportionalValueRepository::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->facade = new GiftCardProportionalValueFacade();
        $this->facade->setEntityManager($this->entityManagerMocks);
        $this->facade->setRepository($this->repositoryMocks);
    }

    /**
     * @return void
     */
    public function testFindOrCreateProportionalGiftCardValue(): void
    {
        $this->entityManagerMocks->expects(static::atLeastOnce())
            ->method('findOrCreateProportionalGiftCardValue')
            ->willReturn($this->proportionalGiftCardValueTransferMock);

        $this->facade->findOrCreateProportionalGiftCardValue($this->proportionalGiftCardValueTransferMock);
    }

    /**
     * @return void
     */
    public function testFindProportionalGiftCardValue(): void
    {
        $this->repositoryMocks->expects(static::atLeastOnce())
            ->method('findProportionalGiftCardValue')
            ->willReturn($this->proportionalGiftCardValueTransferMock);

        $this->facade->findProportionalGiftCardValue($this->proportionalGiftCardValueTransferMock);
    }

    /**
     * @return void
     */
    public function testFindGiftCardAmountByIdSalesOrderItem(): void
    {
        $this->repositoryMocks->expects(static::atLeastOnce())
            ->method('findGiftCardAmountByIdSalesOrderItem')
            ->willReturn(10);

        $this->facade->findGiftCardAmountByIdSalesOrderItem(1);
    }
}
