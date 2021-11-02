<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestPaymentTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestSplittableCheckoutRequestExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restUserTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\RestPaymentTransfer>
     */
    protected $restPaymentTransferMocks;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpander
     */
    protected $restSplittableCheckoutRequestExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(SplittableCheckoutRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
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

        $this->restSplittableCheckoutRequestExpander = new RestSplittableCheckoutRequestExpander($this->configMock);
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

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('setCustomerReference')
            ->with($customerReference)
            ->willReturn($this->restSplittableCheckoutRequestTransferMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getPaymentProviderMethodToStateMachineMapping')
            ->willReturn($paymentProviderMethodToStateMachineMapping);

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
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
            $this->restSplittableCheckoutRequestTransferMock,
            $this->restSplittableCheckoutRequestExpander->expand(
                $this->restSplittableCheckoutRequestTransferMock,
                $this->restRequestMock,
            ),
        );
    }
}
