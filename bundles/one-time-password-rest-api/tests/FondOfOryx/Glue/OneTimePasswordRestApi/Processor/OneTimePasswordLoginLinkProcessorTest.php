<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi\Processor;

use Codeception\Test\Unit;
use FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiClientInterface;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Response;

class OneTimePasswordLoginLinkProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordLoginLinkProcessor
     */
    protected $oneTimePasswordLoginLinkProcessor;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $oneTimePasswordRestApiClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|mixed
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restOneTimePasswordLoginLinkRequestAttributesTransferMock;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restOneTimePasswordResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordRestApiClientMock = $this->getMockBuilder(OneTimePasswordRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordLoginLinkRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->email = 'email';

        $this->restOneTimePasswordResponseTransferMock = $this->getMockBuilder(RestOneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordLoginLinkProcessor = new OneTimePasswordLoginLinkProcessor(
            $this->restResourceBuilderMock,
            $this->oneTimePasswordRestApiClientMock,
        );
    }

    /**
     * @return void
     */
    public function testRequestOneTimePasswordEmail(): void
    {
        $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn($this->email);

        $this->oneTimePasswordRestApiClientMock->expects($this->atLeastOnce())
            ->method('requestOneTimePasswordLoginLink')
            ->willReturn($this->restOneTimePasswordResponseTransferMock);

        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('setStatus')
            ->with(Response::HTTP_NO_CONTENT)
            ->willReturnSelf();

        $this->assertSame(
            $this->restResponseMock,
            $this->oneTimePasswordLoginLinkProcessor->requestOneTimePasswordEmail(
                $this->restRequestMock,
                $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testRequestOneTimePasswordEmailError(): void
    {
        $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn(null);

        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturnSelf();

        $this->assertSame(
            $this->restResponseMock,
            $this->oneTimePasswordLoginLinkProcessor->requestOneTimePasswordEmail(
                $this->restRequestMock,
                $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock,
            ),
        );
    }
}
