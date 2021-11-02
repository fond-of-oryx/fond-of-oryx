<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\Model\GiftCard;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilterInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductConfigurationWriter;
use FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class GiftCardProductConfigurationWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $giftCardAmountFilterMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductConfigurationWriterInterface
     */
    protected $giftCardProductConfigurationWriter;

    /**
     * @var \Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardProductConfigurationEntityTransfer;

    /**
     * @var \ArrayObject<\PHPUnit\Framework\MockObject\MockObject>|\ArrayObject<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    protected $priceProductTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductConcreteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productConcreteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandlerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->giftCardAmountFilterMock = $this->getMockBuilder(GiftCardAmountFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(GiftCardProductConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(GiftCardProductConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductTransferMocks = new ArrayObject(
            [
                $this->getMockBuilder(PriceProductTransfer::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
            ],
        );

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productConcreteTransferMock = $this->getMockBuilder(ProductConcreteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConfigurationEntityTransfer = $this->getMockBuilder(SpyGiftCardProductConfigurationEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConfigurationWriter = new class (
            $this->giftCardAmountFilterMock,
            $this->entityManagerMock,
            $this->configMock,
            $this->transactionHandlerMock
        ) extends GiftCardProductConfigurationWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @param \FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilterInterface $giftCardAmountFilter
             * @param \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig $config
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(
                GiftCardAmountFilterInterface $giftCardAmountFilter,
                GiftCardProductConnectorEntityManagerInterface $entityManager,
                GiftCardProductConnectorConfig $config,
                TransactionHandlerInterface $transactionHandler
            ) {
                parent::__construct($giftCardAmountFilter, $entityManager, $config);
                $this->transactionHandler = $transactionHandler;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            public function getTransactionHandler(): TransactionHandlerInterface
            {
                return $this->transactionHandler;
            }
        };
    }

    /**
     * @return void
     */
    public function testSaveGiftCardProductConfiguration(): void
    {
        $productSkuPrefixes = ['prefix-'];
        $giftCardAmount = 10;

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($closure) {
                    $result = $closure();

                    if (empty($result)) {
                        return;
                    }

                    return $result;
                },
            );

        $this->configMock->expects(static::atLeastOnce())
            ->method('getGiftCardProductSkuPrefixes')
            ->willReturn($productSkuPrefixes);

        $this->productConcreteTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('prefix-sku');

        $this->productConcreteTransferMock->expects(static::atLeastOnce())
            ->method('getPrices')
            ->willReturn($this->priceProductTransferMocks);

        $this->giftCardAmountFilterMock->expects(static::atLeastOnce())
            ->method('filterFromPriceProducts')
            ->with($this->priceProductTransferMocks)
            ->willReturn($giftCardAmount);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('saveGiftCardProductConfiguration')
            ->with($this->productConcreteTransferMock, $giftCardAmount)
            ->willReturn($this->giftCardProductConfigurationEntityTransfer);

        $productConcreteTransferMock = $this->giftCardProductConfigurationWriter
            ->saveGiftCardProductConfiguration($this->productConcreteTransferMock);

        $this->assertInstanceOf(ProductConcreteTransfer::class, $this->productConcreteTransferMock);

        $this->assertEquals($productConcreteTransferMock, $this->productConcreteTransferMock);
    }

    /**
     * @return void
     */
    public function testSaveGiftCardProductConfigurationWithNotGiftCartProduct(): void
    {
        $productSkuPrefixes = ['prefix-'];

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($closure) {
                    $result = $closure();

                    if (empty($result)) {
                        return;
                    }

                    return $result;
                },
            );

        $this->configMock->expects(static::atLeastOnce())
            ->method('getGiftCardProductSkuPrefixes')
            ->willReturn($productSkuPrefixes);

        $this->productConcreteTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('sku');

        $productConcreteTransferMock = $this->giftCardProductConfigurationWriter
            ->saveGiftCardProductConfiguration($this->productConcreteTransferMock);

        $this->assertInstanceOf(ProductConcreteTransfer::class, $this->productConcreteTransferMock);

        $this->assertEquals($productConcreteTransferMock, $this->productConcreteTransferMock);
    }

    /**
     * @return void
     */
    public function testSaveGiftCardProductConfigurationWithEmptyGiftCartPrefixes(): void
    {
        $productSkuPrefixes = [];

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($closure) {
                    $result = $closure();

                    if (empty($result)) {
                        return;
                    }

                    return $result;
                },
            );

        $this->configMock->expects(static::atLeastOnce())
            ->method('getGiftCardProductSkuPrefixes')
            ->willReturn($productSkuPrefixes);

        $productConcreteTransferMock = $this->giftCardProductConfigurationWriter
            ->saveGiftCardProductConfiguration($this->productConcreteTransferMock);

        $this->assertInstanceOf(ProductConcreteTransfer::class, $this->productConcreteTransferMock);

        $this->assertEquals($productConcreteTransferMock, $this->productConcreteTransferMock);
    }
}
