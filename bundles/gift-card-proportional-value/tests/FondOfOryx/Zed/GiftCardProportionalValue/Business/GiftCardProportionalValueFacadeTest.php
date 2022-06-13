<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\Manager\ProportionalGiftCardValueManagerInterface;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\Validator\HasRedeemedGiftCardValidator;
use FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManager;
use FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueRepository;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class GiftCardProportionalValueFacadeTest extends Unit
{
    /**
     * @var array<\Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $itemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $proportionalGiftCardValueTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueBusinessFactory|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\Validator\HasRedeemedGiftCardValidatorInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $giftCardValidatorMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\Manager\ProportionalGiftCardValueManagerInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $proportionalGiftCardValueManager;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $spySalesOrderMock;

    /**
     * @var \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $readOnlyArrayObjectMock;

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

        $this->itemTransferMock = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->proportionalGiftCardValueTransferMock =
            $this->getMockBuilder(ProportionalGiftCardValueTransfer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->entityManagerMock =
            $this->getMockBuilder(GiftCardProportionalValueEntityManager::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->repositoryMock =
            $this->getMockBuilder(GiftCardProportionalValueRepository::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->factoryMock =
            $this->getMockBuilder(GiftCardProportionalValueBusinessFactory::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->giftCardValidatorMock =
            $this->getMockBuilder(HasRedeemedGiftCardValidator::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->proportionalGiftCardValueManager =
            $this->getMockBuilder(ProportionalGiftCardValueManagerInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesOrderItemMock =
            $this->getMockBuilder(SpySalesOrderItem::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesOrderMock =
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->readOnlyArrayObjectMock =
            $this->getMockBuilder(ReadOnlyArrayObject::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->facade = new GiftCardProportionalValueFacade();
        $this->facade->setEntityManager($this->entityManagerMock);
        $this->facade->setRepository($this->repositoryMock);
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindOrCreateProportionalGiftCardValue(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('findOrCreateProportionalGiftCardValue')
            ->willReturn($this->proportionalGiftCardValueTransferMock);

        $this->facade->findOrCreateProportionalGiftCardValue($this->proportionalGiftCardValueTransferMock);
    }

    /**
     * @return void
     */
    public function testFindProportionalGiftCardValue(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findProportionalGiftCardValue')
            ->willReturn($this->proportionalGiftCardValueTransferMock);

        $this->facade->findProportionalGiftCardValue($this->proportionalGiftCardValueTransferMock);
    }

    /**
     * @return void
     */
    public function testFindGiftCardAmountByIdSalesOrderItem(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findGiftCardAmountByIdSalesOrderItem')
            ->willReturn(10);

        $this->facade->findGiftCardAmountByIdSalesOrderItem(1);
    }

    /**
     * @return void
     */
    public function testHasRedeemedGiftCards(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createHasRedeemedGiftCardValidator')
            ->willReturn($this->giftCardValidatorMock);

        $this->giftCardValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->willReturn(true);

        $this->facade->hasRedeemedGiftCards($this->spySalesOrderItemMock);
    }

    /**
     * @return void
     */
    public function testCreateProportionalValues(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createManager')
            ->willReturn($this->proportionalGiftCardValueManager);

        $this->proportionalGiftCardValueManager->expects(static::atLeastOnce())
            ->method('createProportionalValues')
            ->willReturn([]);

        $this->facade->createProportionalValues([$this->spySalesOrderItemMock], $this->spySalesOrderMock, $this->readOnlyArrayObjectMock);
    }
}
