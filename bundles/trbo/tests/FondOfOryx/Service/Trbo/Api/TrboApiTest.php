<?php

namespace FondOfOryx\Service\Trbo\Api;

use Codeception\Test\Unit;
use FondOfOryx\Service\Trbo\Mapper\TrboMapper;
use Generated\Shared\Transfer\TrboTransfer;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;

class TrboApiTest extends Unit
{
    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Service\Trbo\Api\TrboApiConfigurationInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $trboApiConfigurationMock;

    /**
     * @var \FondOfOryx\Service\Trbo\Mapper\TrboMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $trboMapperMock;

    /**
     * @var \Symfony\Component\HttpFoundation\Request|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestMock;

    /**
     * @var \GuzzleHttp\Psr7\Response|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $responseMock;

    /**
     * @var \GuzzleHttp\Psr7\Stream|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $streamMock;

    /**
     * @var \Generated\Shared\Transfer\TrboTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $trboTransferMock;

    /**
     * @var \FondOfOryx\Service\Trbo\Api\TrboApi
     */
    protected $trboApi;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->loggerMock = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->trboApiConfigurationMock = $this->getMockBuilder(TrboApiConfiguration::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->trboMapperMock = $this->getMockBuilder(TrboMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMock = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->streamMock = $this->getMockBuilder(Stream::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->trboTransferMock = $this->getMockBuilder(TrboTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->trboApi = new TrboApi($this->loggerMock, $this->clientMock, $this->trboApiConfigurationMock, $this->trboMapperMock);
    }

    /**
     * @return void
     */
    public function testRequestData(): void
    {
        $jsonResponse = '{"data":[{"contentfulEntry":"6XYCb2RiH3gcPFTDMObBA0"}],"tracking":[{"module_id":199885,"campaign_id":"85011","module_name":"s2s-Test","campaign_name":"s2s-Test","user_type":"trbo"}],"debug":[{"latitude":"51.045925","longitude":"7.019220","postal_code":false,"country":"DE","region":"nw","city":"leverkusen","source":"gcp"}]}';

        $this->trboApiConfigurationMock->expects(static::atLeastOnce())
            ->method('getApiUrl')
            ->willReturn('api.url.sample');

        $this->trboApiConfigurationMock->expects(static::atLeastOnce())
            ->method('getConfiguration')
            ->willReturn([
                'timeout' => '0.3',
                'headers' => [
                    'X-REQUEST-SHOPID' => '00001',
                    'X-REQUEST-CLIENTID' => '001',
                    'X-REQUEST-APIKEY' => 'API_KEY',
                ],
                'json' => [
                    'globals' => [
                        'userId' => 'user_id',
                        'ip' => '127.0.0.1',
                        'location' => 'sample.com',
                        'referrer' => null,
                    ],
                    'datalayer' => [
                        'requestOrigin' => 'serverside',
                    ],
                ],
            ]);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('request')
            ->willReturn($this->responseMock);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getBody')
            ->willReturn($this->streamMock);

        $this->streamMock->expects(static::atLeastOnce())
            ->method('getContents')
            ->willReturn($jsonResponse);

        $this->trboMapperMock->expects(static::atLeastOnce())
            ->method('mapApiResponseToTransfer')
            ->willReturn($this->trboTransferMock);

        $this->loggerMock->expects(static::never())
            ->method('alert');

        $trboTransfer = $this->trboApi->requestData($this->requestMock);

        static::assertEquals($trboTransfer, $this->trboTransferMock);
    }
}
