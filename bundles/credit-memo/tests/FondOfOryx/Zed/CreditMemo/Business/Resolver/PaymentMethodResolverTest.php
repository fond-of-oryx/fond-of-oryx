<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Resolver;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CreditMemo\Exception\SalesPaymentMethodTypeNotFoundException;
use FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepository;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer;

class PaymentMethodResolverTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesPaymentMethodTypeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\Resolver\ResolverInterface
     */
    protected $resolver;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CreditMemoRepository::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoTransferMock = $this->getMockBuilder(CreditMemoTransfer::class)->disableOriginalConstructor()->getMock();
        $this->salesPaymentMethodTypeTransferMock = $this->getMockBuilder(SalesPaymentMethodTypeTransfer::class)->disableOriginalConstructor()->getMock();

        $this->resolver = new PaymentMethodResolver($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testResolveAndAdd(): void
    {
        $this->creditMemoTransferMock->expects(static::once())->method('getFkSalesOrder')->willReturn(1);
        $this->creditMemoTransferMock->expects(static::once())->method('setFkSalesPaymentMethodType')->willReturn($this->creditMemoTransferMock);
        $this->creditMemoTransferMock->expects(static::once())->method('setSalesPaymentMethodType')->willReturn($this->creditMemoTransferMock);
        $this->salesPaymentMethodTypeTransferMock->expects(static::once())->method('getIdSalesPaymentMethodType')->willReturn(2);
        $this->repositoryMock->expects(static::once())->method('getSalesPaymentMethodType')->willReturn($this->salesPaymentMethodTypeTransferMock);

        $this->resolver->resolveAndAdd($this->creditMemoTransferMock);
    }

    /**
     * @return void
     */
    public function testResolveAndAddThrowsException(): void
    {
        $this->creditMemoTransferMock->expects(static::once())->method('getFkSalesOrder')->willReturn(1);
        $this->salesPaymentMethodTypeTransferMock->expects(static::never())->method('getIdSalesPaymentMethodType');
        $this->repositoryMock->expects(static::once())->method('getSalesPaymentMethodType')->willReturn(null);

        $catch = null;
        try {
            $this->resolver->resolveAndAdd($this->creditMemoTransferMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        static::assertInstanceOf(SalesPaymentMethodTypeNotFoundException::class, $catch);
    }
}
