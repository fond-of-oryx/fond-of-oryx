<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade\CreditMemoPayoneDebitConnectorToSalesFacadeInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\PaymentProviderTransfer;
use Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer;
use SprykerEco\Shared\Payone\PayoneApiConstants;

class CreditMemoPayoneDebitConnectorIsDebitExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business\Expander\CreditMemoPayoneDebitConnectorIsDebitExpander
     */
    protected $creditMemoPayoneDebitConnectorIsDebitExpander;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    protected $salesFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesPaymentMethodTypeTransferMock;

    /**
     * @var int
     */
    protected $fkSalesOrder;

    /**
     * @var array<string>
     */
    protected $isDebitTrueOrderStates;

    /**
     * @var string
     */
    protected $isDebitPaymentMethod;

    /**
     * @var string
     */
    protected $isDebitPaymentProvider;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \ArrayObject<\Generated\Shared\Transfer\ItemTransfer>
     */
    protected $items;

    /**
     * @var array<string>
     */
    protected $isDebitFalseOrderStates;

    /**
     * @var \Generated\Shared\Transfer\PaymentMethodTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentMethodTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaymentProviderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentProviderTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->salesFacadeMock = $this->getMockBuilder(CreditMemoPayoneDebitConnectorToSalesFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->creditMemoTransferMock = $this->getMockBuilder(CreditMemoTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesPaymentMethodTypeTransferMock = $this->getMockBuilder(SalesPaymentMethodTypeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fkSalesOrder = 1;

        $this->isDebitTrueOrderStates = [
            'underpaid' => 'underpaid',
        ];

        $this->isDebitFalseOrderStates = [
            'paid' => 'paid',
        ];

        $this->isDebitPaymentMethod = PayoneApiConstants::PAYMENT_METHOD_SECURITY_INVOICE;

        $this->isDebitPaymentProvider = 'Payone';

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->items = new ArrayObject([
            $this->itemTransferMock,
        ]);

        $this->paymentMethodTransferMock = $this->getMockBuilder(PaymentMethodTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentProviderTransferMock = $this->getMockBuilder(PaymentProviderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->creditMemoPayoneDebitConnectorIsDebitExpander = new CreditMemoPayoneDebitConnectorIsDebitExpander(
            $this->salesFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testExpandCreditMemoWithIsDebitTrue(): void
    {
        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('getSalesPaymentMethodType')
            ->willReturn($this->salesPaymentMethodTypeTransferMock);

        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('getFkSalesOrder')
            ->willReturn($this->fkSalesOrder);

        $this->salesFacadeMock->expects(static::atLeastOnce())
            ->method('getDistinctOrderStates')
            ->willReturn($this->isDebitTrueOrderStates);

        $this->salesPaymentMethodTypeTransferMock->expects(static::atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn($this->paymentMethodTransferMock);

        $this->salesPaymentMethodTypeTransferMock->expects(static::atLeastOnce())
            ->method('getPaymentProvider')
            ->willReturn($this->paymentProviderTransferMock);

        $this->paymentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($this->isDebitPaymentMethod);

        $this->paymentProviderTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($this->isDebitPaymentProvider);

        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($this->items);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('setIsDebit')
            ->with(true)
            ->willReturnSelf();

        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('setIsDebit')
            ->with(true)
            ->willReturnSelf();

        $this->assertInstanceOf(
            CreditMemoTransfer::class,
            $this->creditMemoPayoneDebitConnectorIsDebitExpander->expandCreditMemo($this->creditMemoTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandCreditMemoWithIsDebitFalse(): void
    {
        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('getSalesPaymentMethodType')
            ->willReturn($this->salesPaymentMethodTypeTransferMock);

        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('getFkSalesOrder')
            ->willReturn($this->fkSalesOrder);

        $this->salesFacadeMock->expects(static::atLeastOnce())
            ->method('getDistinctOrderStates')
            ->willReturn($this->isDebitFalseOrderStates);

        $this->salesPaymentMethodTypeTransferMock->expects(static::atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn($this->paymentMethodTransferMock);

        $this->salesPaymentMethodTypeTransferMock->expects(static::atLeastOnce())
            ->method('getPaymentProvider')
            ->willReturn($this->paymentProviderTransferMock);

        $this->paymentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($this->isDebitPaymentMethod);

        $this->paymentProviderTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($this->isDebitPaymentProvider);

        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($this->items);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('setIsDebit')
            ->with(false)
            ->willReturnSelf();

        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('setIsDebit')
            ->with(false)
            ->willReturnSelf();

        $this->assertInstanceOf(
            CreditMemoTransfer::class,
            $this->creditMemoPayoneDebitConnectorIsDebitExpander->expandCreditMemo($this->creditMemoTransferMock),
        );
    }
}
