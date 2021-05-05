<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiConfig;
use Generated\Shared\Transfer\RestPaymentTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestSplittableTotalsRequestExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestPaymentTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $restPaymentTransferMocks;

    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander\RestSplittableTotalsRequestExpander
     */
    protected $restSplittableTotalsRequestExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(SplittableTotalsRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restPaymentTransferMocks = [
            $this->getMockBuilder(RestPaymentTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(RestPaymentTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(RestPaymentTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restSplittableTotalsRequestExpander = new RestSplittableTotalsRequestExpander($this->configMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $customerReference = 'FOO-1';
        $paymentProviderMethodToStateMachineMapping = [
            'FooPayment' => [
                'Credit Card' => 'fooPaymentCreditCard',
                'Invoice' => 'fooPaymentInvoice',
            ],
        ];

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn($customerReference);

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('setCustomerReference')
            ->with($customerReference)
            ->willReturn($this->restSplittableTotalsRequestTransferMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getPaymentProviderMethodToStateMachineMapping')
            ->willReturn($paymentProviderMethodToStateMachineMapping);

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getPayments')
            ->willReturn($this->restPaymentTransferMocks);

        $this->restPaymentTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getPaymentProviderName')
            ->willReturn('FooPayment');

        $this->restPaymentTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getPaymentMethodName')
            ->willReturn('Credit Card');

        $this->restPaymentTransferMocks[0]->expects(static::atLeastOnce())
            ->method('setPaymentSelection')
            ->with($paymentProviderMethodToStateMachineMapping['FooPayment']['Credit Card'])
            ->willReturn($this->restPaymentTransferMocks[0]);

        $this->restPaymentTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getPaymentProviderName')
            ->willReturn('BarPayment');

        $this->restPaymentTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getPaymentMethodName')
            ->willReturn('Credit Card');

        $this->restPaymentTransferMocks[1]->expects(static::never())
            ->method('setPaymentSelection');

        $this->restPaymentTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getPaymentProviderName')
            ->willReturn(null);

        $this->restPaymentTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getPaymentMethodName')
            ->willReturn('Credit Card');

        $this->restPaymentTransferMocks[2]->expects(static::never())
            ->method('setPaymentSelection');

        static::assertEquals(
            $this->restSplittableTotalsRequestTransferMock,
            $this->restSplittableTotalsRequestExpander->expand(
                $this->restSplittableTotalsRequestTransferMock,
                $this->restRequestMock
            )
        );
    }
}
