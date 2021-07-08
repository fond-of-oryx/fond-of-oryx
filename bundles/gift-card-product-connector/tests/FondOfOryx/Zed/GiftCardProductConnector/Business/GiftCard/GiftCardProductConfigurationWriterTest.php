<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\Model\Writer;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductConfigurationWriter;
use FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeInterface;
use FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface;
use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class GiftCardProductConfigurationWriterTest extends Unit
{
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
     * @var \Generated\Shared\Transfer\MoneyValueTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $moneyValueTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PriceProductTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $priceProductTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productFacadeMock;

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

        $this->productFacadeMock = $this->getMockBuilder(GiftCardProductConnectorToProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(GiftCardProductConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(GiftCardProductConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductTransferMock = $this->getMockBuilder(PriceProductTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productConcreteTransferMock = $this->getMockBuilder(ProductConcreteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->moneyValueTransferMock = $this->getMockBuilder(MoneyValueTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConfigurationEntityTransfer = $this->getMockBuilder(SpyGiftCardProductConfigurationEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConfigurationWriter = new class (
            $this->productFacadeMock,
            $this->entityManagerMock,
            $this->configMock,
            $this->transactionHandlerMock
        ) extends GiftCardProductConfigurationWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeInterface $productFacade
             * @param \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig $config
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(
                GiftCardProductConnectorToProductFacadeInterface $productFacade,
                GiftCardProductConnectorEntityManagerInterface $entityManager,
                GiftCardProductConnectorConfig $config,
                TransactionHandlerInterface $transactionHandler
            ) {
                parent::__construct($productFacade, $entityManager, $config);
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
        $idProductAbstract = 1;
        $grossAmount = 10;
        $prices = new ArrayObject([$this->priceProductTransferMock]);

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

        $this->productConcreteTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('prefix-sku');

        $this->productConcreteTransferMock->expects(static::atLeastOnce())
            ->method('getFkProductAbstract')
            ->willReturn($idProductAbstract);

        $this->productFacadeMock->expects(static::atLeastOnce())
            ->method('findProductAbstractById')
            ->with($idProductAbstract)
            ->willReturn($this->productAbstractTransferMock);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getPrices')
            ->willReturn($prices);

        $this->priceProductTransferMock->expects(static::atLeastOnce())
            ->method('getMoneyValue')
            ->willReturn($this->moneyValueTransferMock);

        $this->moneyValueTransferMock->expects(static::atLeastOnce())
            ->method('getGrossAmount')
            ->willReturn($grossAmount);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createGiftCardProductConfiguration')
            ->with($this->productConcreteTransferMock, $grossAmount)
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
                }
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
                }
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
