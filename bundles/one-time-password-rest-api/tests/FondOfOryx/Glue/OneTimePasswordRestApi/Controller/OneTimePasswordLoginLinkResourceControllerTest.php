<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiFactory;
use FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordLoginLinkProcessorInterface;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class OneTimePasswordLoginLinkResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\OneTimePasswordRestApi\Controller\OneTimePasswordLoginLinkResourceController
     */
    protected $oneTimePasswordLoginLinkResourceController;

    /**
     * @var \FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiFactory|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $oneTimePasswordRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restOneTimePasswordLoginLinkRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordLoginLinkProcessorInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $oneTimePasswordLoginLinkProcessorMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordRestApiFactoryMock = $this->getMockBuilder(OneTimePasswordRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordLoginLinkRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordLoginLinkProcessorMock = $this->getMockBuilder(OneTimePasswordLoginLinkProcessorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordLoginLinkResourceController = new class ($this->oneTimePasswordRestApiFactoryMock) extends OneTimePasswordLoginLinkResourceController
        {
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
            ->method('createOneTimePasswordLoginLinkProcessor')
            ->willReturn($this->oneTimePasswordLoginLinkProcessorMock);

        $this->oneTimePasswordLoginLinkProcessorMock->expects($this->atLeastOnce())
            ->method('requestOneTimePasswordEmail')
            ->with(
                $this->restRequestMock,
                $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock,
            )
            ->willReturn($this->restResponseMock);

        $this->assertSame(
            $this->restResponseMock,
            $this->oneTimePasswordLoginLinkResourceController->postAction(
                $this->restRequestMock,
                $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock,
            ),
        );
    }
}
