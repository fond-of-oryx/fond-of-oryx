<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi\Processor;

use Codeception\Test\Unit;
use FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiClientInterface;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Response;

class OneTimePasswordProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordProcessor
     */
    protected $oneTimePasswordProcessor;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordRestApiClientMock;

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
     * @var string
     */
    protected $email;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
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

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->email = 'email';

        $this->restOneTimePasswordResponseTransferMock = $this->getMockBuilder(RestOneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordProcessor = new OneTimePasswordProcessor(
            $this->restResourceBuilderMock,
            $this->oneTimePasswordRestApiClientMock,
        );
    }

    /**
     * @return void
     */
    public function testRequestOneTimePasswordEmail(): void
    {
        $this->restOneTimePasswordRequestAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn($this->email);

        $this->oneTimePasswordRestApiClientMock->expects($this->atLeastOnce())
            ->method('requestOneTimePassword')
            ->with($this->restOneTimePasswordRequestAttributesTransferMock)
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
            $this->oneTimePasswordProcessor->requestOneTimePasswordEmail(
                $this->restRequestMock,
                $this->restOneTimePasswordRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testRequestOneTimePasswordEmailWithoutEmailAddress(): void
    {
        $this->restOneTimePasswordRequestAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn('');

        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturnSelf();

        $this->assertSame(
            $this->restResponseMock,
            $this->oneTimePasswordProcessor->requestOneTimePasswordEmail(
                $this->restRequestMock,
                $this->restOneTimePasswordRequestAttributesTransferMock,
            ),
        );
    }
}
