<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business\Workflow;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckout\Communication\Plugin\PermissionExtension\PlaceOrderPermissionPlugin;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class SplittableCheckoutWorkflowTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface
     */
    protected $checkoutFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface;
     */
    protected $splittableQuoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface
     */
    protected $quoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface
     */
    protected $permissionFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface|null
     */
    protected $identifierExtractorPluginMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandlerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CheckoutResponseTransfer
     */
    protected $checkoutResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SaveOrderTransfer
     */
    protected $saveOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflow
     */
    protected $splittableCheckoutWorkflow;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->checkoutFacadeMock = $this->getMockBuilder(SplittableCheckoutToCheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableQuoteFacadeMock = $this->getMockBuilder(SplittableCheckoutToSplittableQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(SplittableCheckoutToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionFacadeMock = $this->getMockBuilder(SplittableCheckoutToPermissionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->identifierExtractorPluginMock = $this->getMockBuilder(IdentifierExtractorPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->saveOrderTransferMock = $this->getMockBuilder(SaveOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->checkoutResponseTransferMock = $this->getMockBuilder(CheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutWorkflow = new class (
            $this->checkoutFacadeMock,
            $this->splittableQuoteFacadeMock,
            $this->quoteFacadeMock,
            $this->permissionFacadeMock,
            $this->identifierExtractorPluginMock,
            $this->transactionHandlerMock
        ) extends SplittableCheckoutWorkflow {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade
             * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface $splittableQuoteFacade
             * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface $quoteFacade
             * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface $permissionFacade
             * @param \FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface|null $identifierExtractorPlugin
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(
                SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade,
                SplittableCheckoutToSplittableQuoteFacadeInterface $splittableQuoteFacade,
                SplittableCheckoutToQuoteFacadeInterface $quoteFacade,
                SplittableCheckoutToPermissionFacadeInterface $permissionFacade,
                ?IdentifierExtractorPluginInterface $identifierExtractorPlugin,
                TransactionHandlerInterface $transactionHandler
            ) {
                parent::__construct(
                    $checkoutFacade,
                    $splittableQuoteFacade,
                    $quoteFacade,
                    $permissionFacade,
                    $identifierExtractorPlugin,
                );
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
    public function testPlaceOrderWithSplittingErrors(): void
    {
        $identifier = 1;

        $this->identifierExtractorPluginMock->expects(static::atLeastOnce())
            ->method('extract')
            ->with($this->quoteTransferMock)
            ->willReturn($identifier);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(PlaceOrderPermissionPlugin::KEY, $identifier)
            ->willReturn(true);

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

        $this->splittableQuoteFacadeMock->expects(static::atLeastOnce())
            ->method('splitQuote')
            ->with($this->quoteTransferMock)
            ->willReturn([]);

        $this->quoteFacadeMock->expects(static::never())
            ->method('createQuote');

        $this->checkoutFacadeMock->expects(static::never())
            ->method('placeOrder');

        $this->quoteFacadeMock->expects(static::never())
            ->method('deleteQuote');

        $splittableCheckoutResponseTransfer = $this->splittableCheckoutWorkflow->placeOrder($this->quoteTransferMock);

        static::assertEquals(false, $splittableCheckoutResponseTransfer->getIsSuccess());
        static::assertEquals([], $splittableCheckoutResponseTransfer->getOrderReferences());
        static::assertEquals(1, $splittableCheckoutResponseTransfer->getErrors()->count());
    }

    /**
     * @return void
     */
    public function testPlaceOrderWithPersistingErrors(): void
    {
        $splittedQuoteTransferMocks = ['*' => $this->quoteTransferMock];
        $identifier = 1;

        $this->identifierExtractorPluginMock->expects(static::atLeastOnce())
            ->method('extract')
            ->with($this->quoteTransferMock)
            ->willReturn($identifier);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(PlaceOrderPermissionPlugin::KEY, $identifier)
            ->willReturn(true);

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

        $this->splittableQuoteFacadeMock->expects(static::atLeastOnce())
            ->method('splitQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($splittedQuoteTransferMocks);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('createQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn(null);

        $this->quoteResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->checkoutFacadeMock->expects(static::never())
            ->method('placeOrder');

        $this->quoteFacadeMock->expects(static::never())
            ->method('deleteQuote');

        $splittableCheckoutResponseTransfer = $this->splittableCheckoutWorkflow->placeOrder($this->quoteTransferMock);

        static::assertEquals(false, $splittableCheckoutResponseTransfer->getIsSuccess());
        static::assertEquals([], $splittableCheckoutResponseTransfer->getOrderReferences());
        static::assertEquals(1, $splittableCheckoutResponseTransfer->getErrors()->count());
    }

    /**
     * @return void
     */
    public function testPlaceOrderWithErrors(): void
    {
        $splittedQuoteTransferMocks = ['*' => $this->quoteTransferMock];
        $identifier = 1;

        $this->identifierExtractorPluginMock->expects(static::atLeastOnce())
            ->method('extract')
            ->with($this->quoteTransferMock)
            ->willReturn($identifier);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(PlaceOrderPermissionPlugin::KEY, $identifier)
            ->willReturn(true);

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

        $this->splittableQuoteFacadeMock->expects(static::atLeastOnce())
            ->method('splitQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($splittedQuoteTransferMocks);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('createQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn($this->quoteTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->checkoutFacadeMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->quoteTransferMock)
            ->willReturn($this->checkoutResponseTransferMock);

        $this->checkoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSaveOrder')
            ->willReturn(null);

        $this->checkoutResponseTransferMock->expects(static::never())
            ->method('getIsSuccess');

        $this->quoteFacadeMock->expects(static::never())
            ->method('deleteQuote');

        $splittableCheckoutResponseTransfer = $this->splittableCheckoutWorkflow->placeOrder($this->quoteTransferMock);

        static::assertEquals(false, $splittableCheckoutResponseTransfer->getIsSuccess());
        static::assertEquals([], $splittableCheckoutResponseTransfer->getOrderReferences());
        static::assertEquals(1, $splittableCheckoutResponseTransfer->getErrors()->count());
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $orderReference = 'FOO-1';
        $splittedQuoteTransferMocks = ['*' => $this->quoteTransferMock];
        $identifier = 1;

        $this->identifierExtractorPluginMock->expects(static::atLeastOnce())
            ->method('extract')
            ->with($this->quoteTransferMock)
            ->willReturn($identifier);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(PlaceOrderPermissionPlugin::KEY, $identifier)
            ->willReturn(true);

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

        $this->splittableQuoteFacadeMock->expects(static::atLeastOnce())
            ->method('splitQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($splittedQuoteTransferMocks);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('createQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn($this->quoteTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->checkoutFacadeMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->quoteTransferMock)
            ->willReturn($this->checkoutResponseTransferMock);

        $this->checkoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSaveOrder')
            ->willReturn($this->saveOrderTransferMock);

        $this->checkoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->saveOrderTransferMock->expects(static::atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($orderReference);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('deleteQuote')
            ->with($this->quoteTransferMock);

        $splittableCheckoutResponseTransfer = $this->splittableCheckoutWorkflow->placeOrder($this->quoteTransferMock);

        static::assertEquals(true, $splittableCheckoutResponseTransfer->getIsSuccess());
        static::assertEquals([$orderReference], $splittableCheckoutResponseTransfer->getOrderReferences());
        static::assertEquals(0, $splittableCheckoutResponseTransfer->getErrors()->count());
    }

    /**
     * @return void
     */
    public function testPlaceOrderWithNullableIdentifierExtractorPlugin(): void
    {
        $orderReference = 'FOO-1';
        $splittedQuoteTransferMocks = ['*' => $this->quoteTransferMock];
        $splittableCheckoutWorkflow = new class (
            $this->checkoutFacadeMock,
            $this->splittableQuoteFacadeMock,
            $this->quoteFacadeMock,
            $this->permissionFacadeMock,
            null,
            $this->transactionHandlerMock
        ) extends SplittableCheckoutWorkflow {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade
             * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface $splittableQuoteFacade
             * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface $quoteFacade
             * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface $permissionFacade
             * @param \FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface|null $identifierExtractorPlugin
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(
                SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade,
                SplittableCheckoutToSplittableQuoteFacadeInterface $splittableQuoteFacade,
                SplittableCheckoutToQuoteFacadeInterface $quoteFacade,
                SplittableCheckoutToPermissionFacadeInterface $permissionFacade,
                ?IdentifierExtractorPluginInterface $identifierExtractorPlugin,
                TransactionHandlerInterface $transactionHandler
            ) {
                parent::__construct(
                    $checkoutFacade,
                    $splittableQuoteFacade,
                    $quoteFacade,
                    $permissionFacade,
                    $identifierExtractorPlugin,
                );
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

        $this->permissionFacadeMock->expects(static::never())
            ->method('can');

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

        $this->splittableQuoteFacadeMock->expects(static::atLeastOnce())
            ->method('splitQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($splittedQuoteTransferMocks);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('createQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn($this->quoteTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->checkoutFacadeMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->quoteTransferMock)
            ->willReturn($this->checkoutResponseTransferMock);

        $this->checkoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSaveOrder')
            ->willReturn($this->saveOrderTransferMock);

        $this->checkoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->saveOrderTransferMock->expects(static::atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($orderReference);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('deleteQuote')
            ->with($this->quoteTransferMock);

        $splittableCheckoutResponseTransfer = $splittableCheckoutWorkflow->placeOrder($this->quoteTransferMock);

        static::assertEquals(true, $splittableCheckoutResponseTransfer->getIsSuccess());
        static::assertEquals([$orderReference], $splittableCheckoutResponseTransfer->getOrderReferences());
        static::assertEquals(0, $splittableCheckoutResponseTransfer->getErrors()->count());
    }

    /**
     * @return void
     */
    public function testPlaceOrderWithNullableIdentifier(): void
    {
        $splittedQuoteTransferMocks = ['*' => $this->quoteTransferMock];
        $identifier = null;

        $this->identifierExtractorPluginMock->expects(static::atLeastOnce())
            ->method('extract')
            ->with($this->quoteTransferMock)
            ->willReturn($identifier);

        $this->permissionFacadeMock->expects(static::never())
            ->method('can');

        $this->transactionHandlerMock->expects(static::never())
            ->method('handleTransaction');

        $this->splittableQuoteFacadeMock->expects(static::never())
            ->method('splitQuote');

        $this->quoteFacadeMock->expects(static::never())
            ->method('createQuote');

        $this->checkoutFacadeMock->expects(static::never())
            ->method('placeOrder');

        $this->quoteFacadeMock->expects(static::never())
            ->method('deleteQuote');

        $splittableCheckoutResponseTransfer = $this->splittableCheckoutWorkflow->placeOrder($this->quoteTransferMock);

        static::assertEquals(false, $splittableCheckoutResponseTransfer->getIsSuccess());
        static::assertEquals([], $splittableCheckoutResponseTransfer->getOrderReferences());
        static::assertEquals(1, $splittableCheckoutResponseTransfer->getErrors()->count());
    }
}
