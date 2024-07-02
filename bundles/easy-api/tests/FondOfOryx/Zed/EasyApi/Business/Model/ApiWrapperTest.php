<?php

namespace FondOfOryx\Zed\EasyApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientInterface;
use FondOfOryx\Zed\EasyApi\EasyApiConfig;
use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;

class ApiWrapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\EasyApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiRequestTransfer|MockObject $easyApiRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\EasyApiFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiFilterTransfer|MockObject $easyApiFilterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientInterface
     */
    protected MockObject|EasyApiToGuzzleClientInterface $guzzleClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\EasyApi\EasyApiConfig
     */
    protected MockObject|EasyApiConfig $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected MockObject|LoggerInterface $loggerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Http\Message\ResponseInterface
     */
    protected MockObject|ResponseInterface $responseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Http\Message\StreamInterface
     */
    protected MockObject|StreamInterface $streamMock;

    /**
     * @var \FondOfOryx\Zed\EasyApi\Business\Model\ApiWrapper
     */
    protected ApiWrapper $wrapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->easyApiRequestTransferMock = $this->getMockBuilder(EasyApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();


        $this->easyApiFilterTransferMock = $this->getMockBuilder(EasyApiFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(EasyApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->guzzleClientMock = $this->getMockBuilder(EasyApiToGuzzleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMock = $this->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->streamMock = $this->getMockBuilder(StreamInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->wrapper = new ApiWrapper(
            $this->guzzleClientMock,
            $this->configMock,
            $this->loggerMock,
        );
    }

    /**
     * @return void
     */
    public function testFindDocument(): void
    {
        $configUrl = 'test/123';
        $this->configMock->expects(static::atLeastOnce())
            ->method('getEasyApiUri')
            ->willReturn($configUrl);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAllowedBodyFields')
            ->willReturn([]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getHeader')
            ->willReturn([]);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getReasonPhrase')
            ->willReturn('');

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getBody')
            ->willReturn('test');

        $this->guzzleClientMock->expects(static::atLeastOnce())
            ->method('request')
            ->withConsecutive(
                ['post'],
                [sprintf('%s/%s', $configUrl, 'api/content/search')],
                []
            )
            ->willReturn($this->responseMock);

        $response = $this->wrapper->findDocument(
            $this->easyApiFilterTransferMock
        );

        static::assertEquals( 200, $response->getStatusCode());
        static::assertEquals( 'json', $response->getType());
        static::assertEquals( sha1('test'), $response->getHash());
    }

}
