<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Reader\SplittableTotalsReaderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiFactory;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class SplittableTotalsResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Reader\SplittableTotalsReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestAttributesTransferMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Controller\SplittableTotalsResourceController
     */
    protected $splittableTotalsResourceController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(SplittableCheckoutRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsReaderMock = $this->getMockBuilder(SplittableTotalsReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestAttributesTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsResourceController = new class ($this->factoryMock) extends SplittableTotalsResourceController {
            /**
             * @var \Spryker\Glue\Kernel\AbstractFactory
             */
            protected $abstractFactory;

            /**
             * @param \Spryker\Glue\Kernel\AbstractFactory $abstractFactory
             */
            public function __construct(AbstractFactory $abstractFactory)
            {
                $this->abstractFactory = $abstractFactory;
            }

            /**
             * @return \Spryker\Glue\Kernel\AbstractFactory
             */
            protected function getFactory(): AbstractFactory
            {
                return $this->abstractFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testPostAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createSplittableTotalsReader')
            ->willReturn($this->splittableTotalsReaderMock);

        $this->splittableTotalsReaderMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($this->restRequestMock, $this->restSplittableCheckoutRequestAttributesTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->splittableTotalsResourceController->postAction(
                $this->restRequestMock,
                $this->restSplittableCheckoutRequestAttributesTransferMock
            )
        );
    }
}
