<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayone\Communication\Plugin;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayone\Persistence\JellyfishSalesOrderPayoneRepository;
use FondOfOryx\Zed\JellyfishSalesOrderPayone\Persistence\JellyfishSalesOrderPayoneRepositoryInterface;
use Generated\Shared\Transfer\JellyfishOrderPaymentTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderPaymentExpanderPostMapPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayone\Communication\Plugin\JellyfishOrderPaymentExpanderPostMapPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyOrderTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderMock;

    /**
     * @var \Orm\Zed\Payment\Persistence\SpySalesPayment|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesPaymentMock;

    /**
     * @var \Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesPaymentMethodTypeMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderPaymentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishPaymentTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayone\Persistence\JellyfishSalesOrderPayoneRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesPaymentMock = $this->getMockBuilder(SpySalesPayment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesPaymentMethodTypeMock = $this->getMockBuilder(SpySalesPaymentMethodType::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(JellyfishSalesOrderPayoneRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishPaymentTransferMock = $this->getMockBuilder(JellyfishOrderPaymentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new class ($this->repositoryMock) extends JellyfishOrderPaymentExpanderPostMapPlugin {
            /**
             * @var \FondOfOryx\Zed\JellyfishSalesOrderPayone\Persistence\JellyfishSalesOrderPayoneRepositoryInterface
             */
            protected $repository;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\JellyfishSalesOrderPayone\Persistence\JellyfishSalesOrderPayoneRepositoryInterface $repository
             */
            public function __construct(JellyfishSalesOrderPayoneRepositoryInterface $repository)
            {
                $this->repository = $repository;
            }

            /**
             * @return \FondOfOryx\Zed\JellyfishSalesOrderPayone\Persistence\JellyfishSalesOrderPayoneRepositoryInterface
             */
            public function getRepository(): JellyfishSalesOrderPayoneRepositoryInterface
            {
                return $this->repository;
            }
        };
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->repositoryMock->method('findPaymentTransactionIdByIdSalesPayment')->with(1)->willReturn('1');
        $payments = new ArrayObject([$this->jellyfishPaymentTransferMock]);
        $this->jellyOrderTransferMock->expects($this->once())->method('getPayments')->willReturn($payments);
        $this->jellyOrderTransferMock->expects($this->once())->method('setPayments')->willReturn($this->jellyOrderTransferMock);

        $this->salesOrderMock->expects($this->once())->method('getOrdersJoinSalesPaymentMethodType')->willReturn(new ArrayObject([$this->salesPaymentMock]));
        $this->salesPaymentMock->expects($this->once())->method('getSalesPaymentMethodType')->willReturn($this->salesPaymentMethodTypeMock);
        $this->salesPaymentMock->expects($this->once())->method('getIdSalesPayment')->willReturn(1);

        $this->salesPaymentMock->expects($this->once())->method('getAmount')->willReturn(100);
        $this->salesPaymentMethodTypeMock->expects($this->once())->method('getPaymentProvider')->willReturn('payone');
        $this->salesPaymentMethodTypeMock->expects($this->once())->method('getPaymentMethod')->willReturn('paypal');
        $this->jellyfishPaymentTransferMock->expects($this->once())->method('getAmount')->willReturn(100);
        $this->jellyfishPaymentTransferMock->expects($this->once())->method('getProvider')->willReturn('payone');
        $this->jellyfishPaymentTransferMock->expects($this->once())->method('getMethod')->willReturn('paypal');
        $this->jellyfishPaymentTransferMock->expects($this->once())->method('setTransactionId');

        $result = $this->plugin->expand($this->jellyOrderTransferMock, $this->salesOrderMock);
    }

    /**
     * @return void
     */
    public function testExpandNotMatching(): void
    {
        $payments = new ArrayObject([$this->jellyfishPaymentTransferMock]);
        $this->jellyOrderTransferMock->expects($this->once())->method('getPayments')->willReturn($payments);
        $this->jellyOrderTransferMock->expects($this->once())->method('setPayments')->willReturn($this->jellyOrderTransferMock);

        $this->salesOrderMock->expects($this->once())->method('getOrdersJoinSalesPaymentMethodType')->willReturn(new ArrayObject([$this->salesPaymentMock]));
        $this->salesPaymentMock->expects($this->once())->method('getSalesPaymentMethodType')->willReturn($this->salesPaymentMethodTypeMock);

        $this->salesPaymentMock->expects($this->once())->method('getAmount')->willReturn(100);
        $this->salesPaymentMethodTypeMock->expects($this->once())->method('getPaymentProvider')->willReturn('payone');
        $this->salesPaymentMethodTypeMock->expects($this->once())->method('getPaymentMethod')->willReturn('cc');
        $this->jellyfishPaymentTransferMock->expects($this->once())->method('getAmount')->willReturn(100);
        $this->jellyfishPaymentTransferMock->expects($this->once())->method('getProvider')->willReturn('payone');
        $this->jellyfishPaymentTransferMock->expects($this->once())->method('getMethod')->willReturn('paypal');

        $this->repositoryMock->expects($this->never())->method('findPaymentTransactionIdByIdSalesPayment');
        $this->jellyfishPaymentTransferMock->expects($this->never())->method('setTransactionId');
        $this->salesPaymentMock->expects($this->never())->method('getIdSalesPayment');

        $result = $this->plugin->expand($this->jellyOrderTransferMock, $this->salesOrderMock);
    }

    /**
     * @return void
     */
    public function testExpandWithMoreItems(): void
    {
        $this->repositoryMock->method('findPaymentTransactionIdByIdSalesPayment')->will($this->returnCallback(static function ($args) {
            if ($args === 1) {
                return '1';
            }

            if ($args === 2) {
                return '2';
            }

            return '';
        }));

        $jellyPaymentClone = clone $this->jellyfishPaymentTransferMock;
        $payments = new ArrayObject([$this->jellyfishPaymentTransferMock, $jellyPaymentClone]);
        $this->jellyOrderTransferMock->expects($this->once())->method('getPayments')->willReturn($payments);
        $this->jellyOrderTransferMock->expects($this->once())->method('setPayments')->willReturn($this->jellyOrderTransferMock);

        $alesPaymentClone = clone $this->salesPaymentMock;
        $paymentSales = new ArrayObject([$this->salesPaymentMock, $alesPaymentClone]);
        $this->salesOrderMock->expects($this->once())->method('getOrdersJoinSalesPaymentMethodType')->willReturn($paymentSales);
        $this->salesPaymentMock->expects($this->exactly(2))->method('getSalesPaymentMethodType')->willReturn($this->salesPaymentMethodTypeMock);
        $this->salesPaymentMock->expects($this->once())->method('getIdSalesPayment')->willReturn(1);

        $this->salesPaymentMock->expects($this->exactly(2))->method('getAmount')->willReturn(100);

        $alesPaymentClone->expects($this->exactly(2))->method('getSalesPaymentMethodType')->willReturn($this->salesPaymentMethodTypeMock);
        $alesPaymentClone->expects($this->once())->method('getIdSalesPayment')->willReturn(2);
        $alesPaymentClone->expects($this->exactly(2))->method('getAmount')->willReturn(200);

        $this->salesPaymentMethodTypeMock->expects($this->exactly(2))->method('getPaymentProvider')->willReturn('payone');
        $this->salesPaymentMethodTypeMock->expects($this->exactly(2))->method('getPaymentMethod')->willReturn('paypal');
        $this->jellyfishPaymentTransferMock->expects($this->exactly(2))->method('getAmount')->willReturn(100);
        $this->jellyfishPaymentTransferMock->expects($this->once())->method('getProvider')->willReturn('payone');
        $this->jellyfishPaymentTransferMock->expects($this->once())->method('getMethod')->willReturn('paypal');
        $this->jellyfishPaymentTransferMock->expects($this->once())->method('setTransactionId');

        $jellyPaymentClone->expects($this->exactly(2))->method('getAmount')->willReturn(200);
        $jellyPaymentClone->expects($this->once())->method('getProvider')->willReturn('payone');
        $jellyPaymentClone->expects($this->once())->method('getMethod')->willReturn('paypal');
        $jellyPaymentClone->expects($this->once())->method('setTransactionId');

        $result = $this->plugin->expand($this->jellyOrderTransferMock, $this->salesOrderMock);
    }
}
