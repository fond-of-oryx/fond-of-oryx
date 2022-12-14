<?php

namespace FondOfOryx\Yves\Prepayment\Plugin;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Yves\Prepayment\Handler\PrepaymentHandlerInterface;
use FondOfOryx\Yves\Prepayment\PrepaymentFactory;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class PrepaymentHandlerPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Symfony\Component\HttpFoundation\Request|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestMock;

    /**
     * @var \FondOfOryx\Yves\Prepayment\PrepaymentFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Yves\Prepayment\Handler\PrepaymentHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $handlerMock;

    /**
     * @var \Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)->disableOriginalConstructor()->getMock();
        $this->factoryMock = $this->getMockBuilder(PrepaymentFactory::class)->disableOriginalConstructor()->getMock();
        $this->requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $this->handlerMock = $this->getMockBuilder(PrepaymentHandlerInterface::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new class ($this->factoryMock) extends PrepaymentHandlerPlugin {
            /**
             * @var \FondOfOryx\Yves\Prepayment\PrepaymentFactory
             */
            protected $factoryMock;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Yves\Prepayment\PrepaymentFactory $factory
             */
            public function __construct(PrepaymentFactory $factory)
            {
                $this->factoryMock = $factory;
            }

            /**
             * @return \Spryker\Yves\Kernel\FactoryInterface
             */
            protected function getFactory(): FactoryInterface
            {
                return $this->factoryMock;
            }
        };
    }

    /**
     * @return void
     */
    public function testAddToDataClass(): void
    {
        $this->factoryMock->expects(static::once())->method('createPrepaymentHandler')->willReturn($this->handlerMock);
        $this->handlerMock->expects(static::once())->method('addPaymentToQuote')->willReturn($this->quoteTransferMock);

        $this->plugin->addToDataClass($this->requestMock, $this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testAddToDataClassThrowsException(): void
    {
        $this->factoryMock->expects(static::never())->method('createPrepaymentHandler');
        $this->handlerMock->expects(static::never())->method('addPaymentToQuote');

        $catch = null;
        try {
            $this->plugin->addToDataClass($this->requestMock, new PaymentTransfer());// @phpstan-ignore-line
        } catch (Exception $exception) {
            $catch = $exception;
        }

        static::assertNotNull($catch);
        static::assertSame($catch->getMessage(), 'wrong transfer given Generated\Shared\Transfer\QuoteTransfer!==Generated\Shared\Transfer\PaymentTransfer!');
    }
}
