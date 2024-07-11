<?php

namespace FondOfOryx\Zed\EasyApi\Business\Model;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientInterface;
use FondOfOryx\Zed\EasyApi\EasyApiConfig;
use Generated\Shared\Transfer\EasyApiFilterConditionTransfer;
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
     * @var \Generated\Shared\Transfer\EasyApiFilterConditionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiFilterConditionTransfer|MockObject $easyApiFilterConditionTransferMock;

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

        $this->easyApiFilterConditionTransferMock = $this->getMockBuilder(EasyApiFilterConditionTransfer::class)
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
        $self = $this;
        $configUrl = 'test/123';
        $this->configMock->expects(static::atLeastOnce())
            ->method('getEasyApiUri')
            ->willReturn($configUrl);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAllowedBodyFields')
            ->willReturn([]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getJsonHeader')
            ->willReturn([]);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getReasonPhrase')
            ->willReturn('');

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getBody')
            ->willReturn($this->streamMock);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getHeader')
            ->willReturn([]);

        $this->streamMock->expects(static::atLeastOnce())
            ->method('getContents')
            ->willReturn('test');

        $this->easyApiFilterTransferMock->expects(static::atLeastOnce())
            ->method('getConditions')
            ->willReturn(new ArrayObject());

        $this->guzzleClientMock->expects(static::atLeastOnce())
            ->method('request')->willReturnCallback(static function ($type, $url, $data) use ($self) {
                static::assertEquals('post', $type);
                static::assertEquals(sprintf('%s/%s', 'test/123', 'api/content/search'), $url);
                static::assertEquals(['body' => '[]'], $data);

                return $self->responseMock;
            });

        $response = $this->wrapper->findDocument(
            $this->easyApiFilterTransferMock,
        );

        static::assertEquals(200, $response->getStatusCode());
        static::assertEquals('json', $response->getType());
        static::assertEquals(sha1('test'), $response->getHash());
    }

    /**
     * @return void
     */
    public function testFindDocumentCreateConditions(): void
    {
        $header = [
        'headers' => [
            'Content-Type' => 'application/json',
        ]];

        $conditions = new ArrayObject();
        $conditions->append($this->easyApiFilterConditionTransferMock);
        $configUrl = 'test/123';
        $self = $this;

        $this->configMock->expects(static::atLeastOnce())
            ->method('getEasyApiUri')
            ->willReturn($configUrl);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAllowedBodyFields')
            ->willReturn(['conditions', 'stores']);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getJsonHeader')
            ->willReturn($header);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getReasonPhrase')
            ->willReturn('');

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getBody')
            ->willReturn($this->streamMock);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getHeader')
            ->willReturn([]);

        $this->streamMock->expects(static::atLeastOnce())
            ->method('getContents')
            ->willReturn('test');

        $this->easyApiFilterTransferMock->expects(static::atLeastOnce())
            ->method('getConditions')
            ->willReturn($conditions);

        $this->easyApiFilterTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn(json_decode('{"stores":["storename"],"error":null,"conditions":[{"field":"test","value":"ab"}]}', true));

        $this->easyApiFilterConditionTransferMock->expects(static::atLeastOnce())
            ->method('getField')
            ->willReturn('test');

        $this->easyApiFilterConditionTransferMock->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn('ab');

        $this->guzzleClientMock->expects(static::atLeastOnce())
            ->method('request')->willReturnCallback(static function ($type, $url, $data) use ($self, $configUrl, $header) {
                static::assertEquals('post', $type);
                static::assertEquals(sprintf('%s/%s', $configUrl, 'api/content/search'), $url);
                static::assertEquals(array_merge($header, ['body' => '{"conditions":{"test":"ab"},"stores":["storename"]}']), $data);

                return $self->responseMock;
            });

        $response = $this->wrapper->findDocument(
            $this->easyApiFilterTransferMock,
        );

        static::assertEquals(200, $response->getStatusCode());
        static::assertEquals('json', $response->getType());
        static::assertEquals(sha1('test'), $response->getHash());
    }

    /**
     * @return void
     */
    public function testGetFile(): void
    {
        $self = $this;
        $transferUri = 'file/download';
        $configUrl = 'https://test/';

        $this->configMock->expects(static::atLeastOnce())
            ->method('getEasyApiUri')
            ->willReturn($configUrl);

        $this->easyApiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getUri')
            ->willReturn($transferUri);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getOctetStreamHeader')
            ->willReturn([]);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getReasonPhrase')
            ->willReturn('');

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getBody')
            ->willReturn($this->streamMock);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getHeader')
            ->willReturn([]);

        $this->streamMock->expects(static::atLeastOnce())
            ->method('getContents')
            ->willReturn('test');

        $this->guzzleClientMock->expects(static::atLeastOnce())
            ->method('request')->willReturnCallback(static function ($type, $url, $data) use ($self, $configUrl, $transferUri) {
                static::assertEquals('get', $type);
                static::assertEquals(sprintf('%s/%s/%s', $configUrl, 'api/content/docs', $transferUri), $url);
                static::assertEquals([], $data);

                return $self->responseMock;
            });

        $response = $this->wrapper->getFile(
            $this->easyApiRequestTransferMock,
        );

        static::assertEquals(200, $response->getStatusCode());
        static::assertEquals('base64string', $response->getType());
        static::assertEquals(sha1(base64_encode('test')), $response->getHash());
    }

    /**
     * @return void
     */
    public function testGetFileWithIdAndReference(): void
    {
        $self = $this;
        $id = '1111';
        $ref = '2222';
        $uri = sprintf('%s/attachments/%s', $id, $ref);
        $configUrl = 'https://test/';

        $this->configMock->expects(static::atLeastOnce())
            ->method('getEasyApiUri')
            ->willReturn($configUrl);

        $this->easyApiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($id);

        $this->easyApiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getDocumentReference')
            ->willReturn($ref);

        $this->easyApiRequestTransferMock->expects(static::atLeastOnce())
            ->method('requireId')
            ->willReturnSelf();

        $this->easyApiRequestTransferMock->expects(static::atLeastOnce())
            ->method('requireDocumentReference')
            ->willReturnSelf();

        $this->configMock->expects(static::atLeastOnce())
            ->method('getOctetStreamHeader')
            ->willReturn([]);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getReasonPhrase')
            ->willReturn('');

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getBody')
            ->willReturn($this->streamMock);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getHeader')
            ->willReturn([]);

        $this->streamMock->expects(static::atLeastOnce())
            ->method('getContents')
            ->willReturn('test');

        $this->guzzleClientMock->expects(static::atLeastOnce())
            ->method('request')->willReturnCallback(static function ($type, $url, $data) use ($self, $configUrl, $uri) {
                static::assertEquals('get', $type);
                static::assertEquals(sprintf('%s/%s/%s', $configUrl, 'api/content/docs', $uri), $url);
                static::assertEquals([], $data);

                return $self->responseMock;
            });

        $response = $this->wrapper->getFile(
            $this->easyApiRequestTransferMock,
        );

        static::assertEquals(200, $response->getStatusCode());
        static::assertEquals('base64string', $response->getType());
        static::assertEquals(sha1(base64_encode('test')), $response->getHash());
    }

    /**
     * @return void
     */
    public function testGetFileWithFilenameSet(): void
    {
        $self = $this;
        $id = '1111';
        $ref = '2222';
        $uri = sprintf('%s/attachments/%s', $id, $ref);
        $configUrl = 'https://test/';
        $responseHeader = ['attachment; filename="test.pdf"; size=216243'];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getEasyApiUri')
            ->willReturn($configUrl);

        $this->easyApiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($id);

        $this->easyApiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getDocumentReference')
            ->willReturn($ref);

        $this->easyApiRequestTransferMock->expects(static::atLeastOnce())
            ->method('requireId')
            ->willReturnSelf();

        $this->easyApiRequestTransferMock->expects(static::atLeastOnce())
            ->method('requireDocumentReference')
            ->willReturnSelf();

        $this->configMock->expects(static::atLeastOnce())
            ->method('getOctetStreamHeader')
            ->willReturn([]);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getReasonPhrase')
            ->willReturn('');

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getBody')
            ->willReturn($this->streamMock);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getHeader')
            ->willReturn($responseHeader);

        $this->streamMock->expects(static::atLeastOnce())
            ->method('getContents')
            ->willReturn('test');

        $this->guzzleClientMock->expects(static::atLeastOnce())
            ->method('request')->willReturnCallback(static function ($type, $url, $data) use ($self, $configUrl, $uri) {
                static::assertEquals('get', $type);
                static::assertEquals(sprintf('%s/%s/%s', $configUrl, 'api/content/docs', $uri), $url);
                static::assertEquals([], $data);

                return $self->responseMock;
            });

        $response = $this->wrapper->getFile(
            $this->easyApiRequestTransferMock,
        );

        static::assertEquals(200, $response->getStatusCode());
        static::assertEquals('base64string', $response->getType());
        static::assertEquals('test.pdf', $response->getFileName());
        static::assertEquals(sha1(base64_encode('test')), $response->getHash());
    }
}
