<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\DocumentRestRequestExpanderInterface;
use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class DocumentRestRequestMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DocumentRestRequestTransfer
     */
    protected MockObject|RestRequestInterface $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\DocumentRestRequestExpanderInterface
     */
    protected MockObject|DocumentRestRequestExpanderInterface $expanderMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper\DocumentRestRequestMapper
     */
    protected DocumentRestRequestMapper $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->expanderMock = $this->getMockBuilder(DocumentRestRequestExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new DocumentRestRequestMapper($this->expanderMock);
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $this->expanderMock
            ->expects(static::atLeastOnce())
            ->method('expand')
            ->willReturnCallback(static function (RestRequestInterface $restRequest, DocumentRestRequestTransfer $documentRestRequestTransfer) {
                static::assertInstanceOf(
                    DocumentRestRequestTransfer::class,
                    $documentRestRequestTransfer,
                );

                return $documentRestRequestTransfer;
            });

        static::assertInstanceOf(
            DocumentRestRequestTransfer::class,
            $this->mapper->fromRestRequest($this->restRequestMock),
        );
    }
}
