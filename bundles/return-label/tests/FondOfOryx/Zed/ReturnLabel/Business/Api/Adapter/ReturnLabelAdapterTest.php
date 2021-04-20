<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceBridge;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
use Generated\Shared\Transfer\ReturnLabelServiceRequestTransfer;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class ReturnLabelAdapterTest extends Unit
{
    /**
     * @var \GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $httpClientMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelConfigMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilEncodingServiceMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelServiceRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelServiceRequestTransferMock;

    /**
     * @var \GuzzleHttp\Psr7\Response|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $responseMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapter
     */
    protected $adapter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->httpClientMock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelConfigMock = $this->getMockBuilder(ReturnLabelConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilEncodingServiceMock = $this->getMockBuilder(ReturnLabelToUtilEncodingServiceBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelServiceRequestTransferMock = $this->getMockBuilder(ReturnLabelServiceRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMock = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->adapter = new ReturnLabelAdapter(
            $this->httpClientMock,
            $this->returnLabelConfigMock,
            $this->utilEncodingServiceMock
        );
    }

    /**
     * @return void
     */
    public function testSendRequest(): void
    {
        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->willReturn('{}');

        $this->returnLabelServiceRequestTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->returnLabelConfigMock->expects(static::atLeastOnce())
            ->method('getApiUsername')
            ->willReturn('username');

        $this->returnLabelConfigMock->expects(static::atLeastOnce())
            ->method('getApiPassword')
            ->willReturn('password');

        $this->returnLabelConfigMock->expects(static::atLeastOnce())
            ->method('getApiBaseUri')
            ->willReturn('api-base-uri');

        $this->httpClientMock->expects(static::atLeastOnce())
            ->method('request')
            ->willReturn($this->responseMock);

        $response = $this->adapter->sendRequest($this->returnLabelServiceRequestTransferMock);
    }
}
