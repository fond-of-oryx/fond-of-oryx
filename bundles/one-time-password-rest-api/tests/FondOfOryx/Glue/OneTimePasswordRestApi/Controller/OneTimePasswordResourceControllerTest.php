<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiFactory;
use FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordProcessorInterface;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class OneTimePasswordResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\OneTimePasswordRestApi\Controller\OneTimePasswordResourceController
     */
    protected $oneTimePasswordResourceController;

    /**
     * @var \FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordRequestAttributesTransferMock;

    /**
     * @var \FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordProcessorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordProcessorMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordRestApiFactoryMock = $this->getMockBuilder(OneTimePasswordRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordProcessorMock = $this->getMockBuilder(OneTimePasswordProcessorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordResourceController = new class ($this->oneTimePasswordRestApiFactoryMock) extends OneTimePasswordResourceController {
            /**
             * @var \FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiFactory
             */
            protected $oneTimePasswordRestApiFactory;

            /**
             * @param \FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiFactory $oneTimePasswordRestApiFactory
             */
            public function __construct(OneTimePasswordRestApiFactory $oneTimePasswordRestApiFactory)
            {
                $this->oneTimePasswordRestApiFactory = $oneTimePasswordRestApiFactory;
            }

            /**
             * @return \FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiFactory
             */
            public function getFactory(): OneTimePasswordRestApiFactory
            {
                return $this->oneTimePasswordRestApiFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testPostAction(): void
    {
        $this->oneTimePasswordRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordProcessor')
            ->willReturn($this->oneTimePasswordProcessorMock);

        $this->oneTimePasswordProcessorMock->expects($this->atLeastOnce())
            ->method('requestOneTimePasswordEmail')
            ->with(
                $this->restRequestMock,
                $this->restOneTimePasswordRequestAttributesTransferMock,
            )
            ->willReturn($this->restResponseMock);

        $this->assertSame(
            $this->restResponseMock,
            $this->oneTimePasswordResourceController->postAction(
                $this->restRequestMock,
                $this->restOneTimePasswordRequestAttributesTransferMock,
            ),
        );
    }
}
