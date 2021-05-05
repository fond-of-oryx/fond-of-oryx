<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Reader\RestSplittableTotalsReaderInterface;
use FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiFactory;
use Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class SplittableTotalsResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Reader\RestSplittableTotalsReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsReaderMock;

    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Controller\SplittableTotalsResourceController
     */
    protected $splittableTotalsResourceController;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(SplittableTotalsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsReaderMock = $this->getMockBuilder(RestSplittableTotalsReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestAttributesTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestAttributesTransfer::class)
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
            ->method('createRestSplittableTotalsReader')
            ->willReturn($this->restSplittableTotalsReaderMock);

        $this->restSplittableTotalsReaderMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($this->restRequestMock, $this->restSplittableTotalsRequestAttributesTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->splittableTotalsResourceController->postAction(
                $this->restRequestMock,
                $this->restSplittableTotalsRequestAttributesTransferMock
            )
        );
    }
}
