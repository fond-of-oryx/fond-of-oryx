<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiInterface;
use FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentTypePluginInterface;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper\DocumentRestRequestMapperInterface;
use Generated\Shared\Transfer\DocumentAttachmentTransfer;
use Generated\Shared\Transfer\DocumentItemTransfer;
use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use Generated\Shared\Transfer\DocumentTransfer;
use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class DocumentReaderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Glue\DocumentsRestApi\Processor\Builder\RestResponseBuilderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestResponseBuilderInterface $restResponseBuilderMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected DocumentsRestApiToEasyApiInterface|MockObject $clientMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper\DocumentRestRequestMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected DocumentRestRequestMapperInterface|MockObject $requestMapperMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected LoggerInterface|MockObject $loggerMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentTypePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected DocumentTypePluginInterface|MockObject $pluginMock;

    /**
     * @var \Generated\Shared\Transfer\DocumentRestRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected DocumentRestRequestTransfer|MockObject $documentRestRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\MessageTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MessageTransfer|MockObject $messageTransferMock;

    /**
     * @var \Generated\Shared\Transfer\EasyApiResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiResponseTransfer|MockObject $easyApiResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\EasyApiFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiFilterTransfer|MockObject $easyApiFilterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestResponseInterface|MockObject $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Processor\Reader\DocumentReader
     */
    protected DocumentReader $reader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(DocumentsRestApiToEasyApiInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMapperMock = $this->getMockBuilder(DocumentRestRequestMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginMock = $this->getMockBuilder(DocumentTypePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->documentRestRequestTransferMock = $this->getMockBuilder(DocumentRestRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiFilterTransferMock = $this->getMockBuilder(EasyApiFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->messageTransferMock = $this->getMockBuilder(MessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiResponseTransferMock = $this->getMockBuilder(EasyApiResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new DocumentReader(
            $this->clientMock,
            $this->requestMapperMock,
            $this->restResponseBuilderMock,
            $this->loggerMock,
            [$this->pluginMock],
        );
    }

    /**
     * @return void
     */
    public function testFindMissingPlugin(): void
    {
        $this->requestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->willReturn($this->documentRestRequestTransferMock);

        $this->documentRestRequestTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('a');

        $this->pluginMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('b');

        $this->loggerMock->expects(static::atLeastOnce())
            ->method('error');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildErrorRestResponse')
            ->willReturn($this->restResponseMock);

        $this->reader->find(
            $this->restRequestMock,
        );
    }

    /**
     * @return void
     */
    public function testFindNoFilterWasCreated(): void
    {
        $this->requestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->willReturn($this->documentRestRequestTransferMock);

        $this->documentRestRequestTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('a');

        $this->pluginMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('a');

        $this->pluginMock->expects(static::atLeastOnce())
            ->method('createEasyApiFilter')
            ->willReturn($this->easyApiFilterTransferMock);

        $this->loggerMock->expects(static::atLeastOnce())
            ->method('error');

        $this->easyApiFilterTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn($this->messageTransferMock);

        $this->messageTransferMock->expects(static::atLeastOnce())
            ->method('getMessage')
            ->willReturn('message');

        $this->messageTransferMock->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn('500');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildErrorRestResponse')
            ->willReturn($this->restResponseMock);

        $this->reader->find(
            $this->restRequestMock,
        );
    }

    /**
     * @return void
     */
    public function testFindNotSuccessful(): void
    {
        $this->requestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->willReturn($this->documentRestRequestTransferMock);

        $this->documentRestRequestTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('a');

        $this->pluginMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('a');

        $this->pluginMock->expects(static::atLeastOnce())
            ->method('createEasyApiFilter')
            ->willReturn($this->easyApiFilterTransferMock);

        $this->loggerMock->expects(static::never())
            ->method('error');

        $this->easyApiFilterTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn(null);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('findDocument')
            ->willReturn($this->easyApiResponseTransferMock);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildErrorRestResponse')
            ->willReturn($this->restResponseMock);

        $this->reader->find(
            $this->restRequestMock,
        );
    }

    /**
     * @return void
     */
    public function testFindNoDocumentFound(): void
    {
        $this->requestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->willReturn($this->documentRestRequestTransferMock);

        $this->documentRestRequestTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('a');

        $this->pluginMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('a');

        $this->pluginMock->expects(static::atLeastOnce())
            ->method('createEasyApiFilter')
            ->willReturn($this->easyApiFilterTransferMock);

        $this->loggerMock->expects(static::never())
            ->method('error');

        $this->easyApiFilterTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn(null);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('findDocument')
            ->willReturn($this->easyApiResponseTransferMock);

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getStatus')
            ->willReturn('success');

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(204);

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getMessage')
            ->willReturn('message');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildErrorRestResponse')
            ->willReturn($this->restResponseMock);

        $this->reader->find(
            $this->restRequestMock,
        );
    }

    /**
     * @return void
     */
    public function testFindHashNotMatching(): void
    {
        $hash = sha1('test');
        $this->requestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->willReturn($this->documentRestRequestTransferMock);

        $this->documentRestRequestTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('a');

        $this->pluginMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('a');

        $this->pluginMock->expects(static::atLeastOnce())
            ->method('createEasyApiFilter')
            ->willReturn($this->easyApiFilterTransferMock);

        $this->loggerMock->expects(static::never())
            ->method('error');

        $this->easyApiFilterTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn(null);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('findDocument')
            ->willReturn($this->easyApiResponseTransferMock);

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getStatus')
            ->willReturn('success');

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getHash')
            ->willReturn($hash);

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn('test2');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildErrorRestResponse')
            ->willReturn($this->restResponseMock);

        $this->reader->find(
            $this->restRequestMock,
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $attachment = (new DocumentAttachmentTransfer())->setId('aaaaaa');
        $item = (new DocumentItemTransfer())->addAttachment($attachment);
        $document = (new DocumentTransfer())->addItem($item);

        $data = json_encode($document->toArray());
        $hash = sha1($data);
        $this->requestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->willReturn($this->documentRestRequestTransferMock);

        $this->documentRestRequestTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('a');

        $this->pluginMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('a');

        $this->pluginMock->expects(static::atLeastOnce())
            ->method('createEasyApiFilter')
            ->willReturn($this->easyApiFilterTransferMock);

        $this->loggerMock->expects(static::never())
            ->method('error');

        $this->easyApiFilterTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn(null);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('findDocument')
            ->willReturn($this->easyApiResponseTransferMock);

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getStatus')
            ->willReturn('success');

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getHash')
            ->willReturn($hash);

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('getDocument')
            ->willReturn($this->easyApiResponseTransferMock);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildDocumentResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildErrorRestResponse');

        $this->reader->find(
            $this->restRequestMock,
        );
    }
}
