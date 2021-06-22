<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Processor;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CreditMemo\CreditMemoConfig;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeBridge;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface;
use FondOfOryx\Zed\CreditMemo\Exception\ProcessorNotFoundException;
use FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepository;
use FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface;
use FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface;
use Generated\Shared\Transfer\CreditMemoCollectionTransfer;
use Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\PaymentProviderTransfer;
use Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;

class CreditMemoProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\CreditMemoConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $processorMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesPaymentTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaymentMethodTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentMethodTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaymentProviderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentProviderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\Processor\CreditMemoProcessorInterface
     */
    protected $processor;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CreditMemoRepository::class)->disableOriginalConstructor()->getMock();
        $this->storeFacadeMock = $this->getMockBuilder(CreditMemoToStoreFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->configMock = $this->getMockBuilder(CreditMemoConfig::class)->disableOriginalConstructor()->getMock();
        $this->processorMock = $this->getMockBuilder(CreditMemoProcessorPluginInterface::class)->disableOriginalConstructor()->getMock();
        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoCollectionTransferMock = $this->getMockBuilder(CreditMemoCollectionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoTransferMock = $this->getMockBuilder(CreditMemoTransfer::class)->disableOriginalConstructor()->getMock();
        $this->salesPaymentTransferMock = $this->getMockBuilder(SalesPaymentMethodTypeTransfer::class)->disableOriginalConstructor()->getMock();
        $this->paymentMethodTransferMock = $this->getMockBuilder(PaymentMethodTransfer::class)->disableOriginalConstructor()->getMock();
        $this->paymentProviderTransferMock = $this->getMockBuilder(PaymentProviderTransfer::class)->disableOriginalConstructor()->getMock();
        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)->disableOriginalConstructor()->getMock();

        $this->processorMock->expects(static::atLeastOnce())->method('getName')->willReturn('testProcessor');

        $this->processor = new class ([$this->processorMock], $this->repositoryMock, $this->storeFacadeMock, $this->configMock, $this->loggerMock) extends CreditMemoProcessor{
            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected $loggerMock;

            /**
             *  constructor.
             *
             * @param array $processor
             * @param \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface $creditMemoRepository
             * @param \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface $store
             * @param \FondOfOryx\Zed\CreditMemo\CreditMemoConfig $config
             * @param \Psr\Log\LoggerInterface $logger
             */
            public function __construct(
                array $processor,
                CreditMemoRepositoryInterface $creditMemoRepository,
                CreditMemoToStoreFacadeInterface $store,
                CreditMemoConfig $config,
                LoggerInterface $logger
            ) {
                parent::__construct($processor, $creditMemoRepository, $store, $config);
                $this->loggerMock = $logger;
            }

            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Psr\Log\LoggerInterface
             */
            protected function getLogger(?LoggerConfigInterface $loggerConfig = null)
            {
                return $this->loggerMock;
            }
        };
    }

    /**
     * @return void
     */
    public function testProcess(): void
    {
        $this->repositoryMock->expects(static::once())->method('findUnprocessedCreditMemoByStore')->willReturn($this->creditMemoCollectionTransferMock);
        $this->storeFacadeMock->expects(static::once())->method('getCurrentStore')->willReturn($this->storeTransferMock);
        $this->configMock->expects(static::once())->method('getProcessSizeMax')->willReturn(10);
        $this->creditMemoCollectionTransferMock->expects(static::once())->method('getCreditMemos')->willReturn([$this->creditMemoTransferMock]);
        $this->creditMemoTransferMock->expects(static::once())->method('getIdCreditMemo')->willReturn(1);
        $this->creditMemoTransferMock->expects(static::once())->method('getSalesPaymentMethodType')->willReturn($this->salesPaymentTransferMock);
        $this->salesPaymentTransferMock->expects(static::once())->method('getPaymentMethod')->willReturn($this->paymentMethodTransferMock);
        $this->salesPaymentTransferMock->expects(static::once())->method('getPaymentProvider')->willReturn($this->paymentProviderTransferMock);
        $this->paymentMethodTransferMock->expects(static::once())->method('getName')->willReturn('test');
        $this->paymentProviderTransferMock->expects(static::once())->method('getName')->willReturn('test');
        $this->processorMock->expects(static::once())->method('canProcess')->willReturn(true);
        $this->processorMock->expects(static::once())->method('process')->willReturn(new CreditMemoProcessorStatusTransfer());

        $response = $this->processor->process([], []);

        static::assertSame(1, $response->getCount());
        static::assertSame(0, $response->getErrorCount());
    }

    /**
     * @return void
     */
    public function testProcessWithGivenPlugins(): void
    {
        $this->repositoryMock->expects(static::once())->method('findUnprocessedCreditMemoByStore')->willReturn($this->creditMemoCollectionTransferMock);
        $this->storeFacadeMock->expects(static::once())->method('getCurrentStore')->willReturn($this->storeTransferMock);
        $this->configMock->expects(static::once())->method('getProcessSizeMax')->willReturn(10);
        $this->creditMemoCollectionTransferMock->expects(static::once())->method('getCreditMemos')->willReturn([$this->creditMemoTransferMock]);
        $this->creditMemoTransferMock->expects(static::once())->method('getIdCreditMemo')->willReturn(1);
        $this->creditMemoTransferMock->expects(static::once())->method('getSalesPaymentMethodType')->willReturn($this->salesPaymentTransferMock);
        $this->salesPaymentTransferMock->expects(static::once())->method('getPaymentMethod')->willReturn($this->paymentMethodTransferMock);
        $this->salesPaymentTransferMock->expects(static::once())->method('getPaymentProvider')->willReturn($this->paymentProviderTransferMock);
        $this->paymentMethodTransferMock->expects(static::once())->method('getName')->willReturn('test');
        $this->paymentProviderTransferMock->expects(static::once())->method('getName')->willReturn('test');
        $this->processorMock->expects(static::once())->method('canProcess')->willReturn(true);
        $this->processorMock->expects(static::once())->method('process')->willReturn(new CreditMemoProcessorStatusTransfer());

        $response = $this->processor->process(['testProcessor'], []);

        static::assertSame(1, $response->getCount());
        static::assertSame(0, $response->getErrorCount());
    }

    /**
     * @return void
     */
    public function testProcessWithGivenIds(): void
    {
        $this->repositoryMock->expects(static::never())->method('findUnprocessedCreditMemoByStore');
        $this->repositoryMock->expects(static::once())->method('findUnprocessedCreditMemoByStoreAndIds')->willReturn($this->creditMemoCollectionTransferMock);
        $this->storeFacadeMock->expects(static::once())->method('getCurrentStore')->willReturn($this->storeTransferMock);
        $this->configMock->expects(static::never())->method('getProcessSizeMax');
        $this->creditMemoCollectionTransferMock->expects(static::once())->method('getCreditMemos')->willReturn([$this->creditMemoTransferMock]);
        $this->creditMemoTransferMock->expects(static::once())->method('getIdCreditMemo')->willReturn(1);
        $this->creditMemoTransferMock->expects(static::once())->method('getSalesPaymentMethodType')->willReturn($this->salesPaymentTransferMock);
        $this->salesPaymentTransferMock->expects(static::once())->method('getPaymentMethod')->willReturn($this->paymentMethodTransferMock);
        $this->salesPaymentTransferMock->expects(static::once())->method('getPaymentProvider')->willReturn($this->paymentProviderTransferMock);
        $this->paymentMethodTransferMock->expects(static::once())->method('getName')->willReturn('test');
        $this->paymentProviderTransferMock->expects(static::once())->method('getName')->willReturn('test');
        $this->processorMock->expects(static::once())->method('canProcess')->willReturn(true);
        $this->processorMock->expects(static::once())->method('process')->willReturn(new CreditMemoProcessorStatusTransfer());

        $response = $this->processor->process([], [1]);

        static::assertSame(1, $response->getCount());
        static::assertSame(0, $response->getErrorCount());
    }

    /**
     * @return void
     */
    public function testProcessWithError(): void
    {
        $this->repositoryMock->expects(static::once())->method('findUnprocessedCreditMemoByStore')->willReturn($this->creditMemoCollectionTransferMock);
        $this->storeFacadeMock->expects(static::once())->method('getCurrentStore')->willReturn($this->storeTransferMock);
        $this->configMock->expects(static::once())->method('getProcessSizeMax')->willReturn(10);
        $this->creditMemoCollectionTransferMock->expects(static::once())->method('getCreditMemos')->willReturn([$this->creditMemoTransferMock]);
        $this->creditMemoTransferMock->expects(static::exactly(2))->method('getIdCreditMemo')->willReturn(1);
        $this->creditMemoTransferMock->expects(static::once())->method('getSalesPaymentMethodType')->willReturn($this->salesPaymentTransferMock);
        $this->salesPaymentTransferMock->expects(static::once())->method('getPaymentMethod')->willReturn($this->paymentMethodTransferMock);
        $this->salesPaymentTransferMock->expects(static::once())->method('getPaymentProvider')->willReturn($this->paymentProviderTransferMock);
        $this->paymentMethodTransferMock->expects(static::once())->method('getName')->willReturn('test');
        $this->paymentProviderTransferMock->expects(static::once())->method('getName')->willReturn('test');
        $this->processorMock->expects(static::once())->method('canProcess')->willReturn(true);
        $this->processorMock->expects(static::once())->method('process')->willThrowException(new Exception('fail'));
        $this->loggerMock->expects(static::once())->method('error');

        $response = $this->processor->process([], []);

        static::assertSame(1, $response->getCount());
        static::assertSame(1, $response->getErrorCount());
    }

    /**
     * @return void
     */
    public function testGetThrowsException(): void
    {
        $catch = null;
        try {
            $this->processor->get('fail');
        } catch (Exception $exception) {
            $catch = $exception;
        }

        static::assertInstanceOf(ProcessorNotFoundException::class, $catch);
    }
}
