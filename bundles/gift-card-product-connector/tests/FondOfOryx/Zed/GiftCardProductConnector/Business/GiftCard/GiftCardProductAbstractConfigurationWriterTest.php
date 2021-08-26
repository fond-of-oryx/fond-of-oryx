<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilterInterface;
use FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class GiftCardProductAbstractConfigurationWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilterInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductAbstractConfigurationWriterInterface
     */
    protected $giftCardProductAbstractConfigurationWriter;

    /**
     * @var \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardProductAbstractConfigurationEntityTransfer;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\PriceProductTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $priceProductTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

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

        $this->giftCardProductAbstractConfigurationEntityTransfer = $this->getMockBuilder(SpyGiftCardProductAbstractConfigurationEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductTransferMocks = new ArrayObject(
            [
                $this->getMockBuilder(PriceProductTransfer::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
            ]
        );

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductAbstractConfigurationWriter = new class (
            $this->giftCardAmountFilterMock,
            $this->entityManagerMock,
            $this->configMock,
            $this->transactionHandlerMock
        ) extends GiftCardProductAbstractConfigurationWriter {

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
    public function testSaveGiftCardProductAbstractConfiguration(): void
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
                }
            );

        $this->configMock->expects(static::atLeastOnce())
            ->method('getGiftCardProductSkuPrefixes')
            ->willReturn($productSkuPrefixes);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('Abstract-prefix-sku');

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getPrices')
            ->willReturn($this->priceProductTransferMocks);

        $this->giftCardAmountFilterMock->expects(static::atLeastOnce())
            ->method('filterFromPriceProducts')
            ->with($this->priceProductTransferMocks)
            ->willReturn($giftCardAmount);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('saveGiftCardProductAbstractConfiguration')
            ->with($this->productAbstractTransferMock, 'prefix-{randomPart}-10')
            ->willReturn($this->giftCardProductAbstractConfigurationEntityTransfer);

        $productAbstractTransferMock = $this->giftCardProductAbstractConfigurationWriter
            ->saveGiftCardProductAbstractConfiguration($this->productAbstractTransferMock);

        $this->assertInstanceOf(ProductAbstractTransfer::class, $this->productAbstractTransferMock);

        $this->assertEquals($productAbstractTransferMock, $this->productAbstractTransferMock);
    }

    /**
     * @return void
     */
    public function testSaveGiftCardProductAbstractConfigurationWithNotGiftCartProduct(): void
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
                }
            );

        $this->configMock->expects(static::atLeastOnce())
            ->method('getGiftCardProductSkuPrefixes')
            ->willReturn($productSkuPrefixes);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('Abstract-sku');

        $productAbstractTransferMock = $this->giftCardProductAbstractConfigurationWriter
            ->saveGiftCardProductAbstractConfiguration($this->productAbstractTransferMock);

        $this->assertInstanceOf(ProductAbstractTransfer::class, $this->productAbstractTransferMock);

        $this->assertEquals($productAbstractTransferMock, $this->productAbstractTransferMock);
    }

    /**
     * @return void
     */
    public function testSaveGiftCardProductAbstractConfigurationWithEmptyGiftCartPrefixes(): void
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
                }
            );

        $this->configMock->expects(static::atLeastOnce())
            ->method('getGiftCardProductSkuPrefixes')
            ->willReturn($productSkuPrefixes);

        $productAbstractTransferMock = $this->giftCardProductAbstractConfigurationWriter
            ->saveGiftCardProductAbstractConfiguration($this->productAbstractTransferMock);

        $this->assertInstanceOf(ProductAbstractTransfer::class, $this->productAbstractTransferMock);

        $this->assertEquals($productAbstractTransferMock, $this->productAbstractTransferMock);
    }
}
