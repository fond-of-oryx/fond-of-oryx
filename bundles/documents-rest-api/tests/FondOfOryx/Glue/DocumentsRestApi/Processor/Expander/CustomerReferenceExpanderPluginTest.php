<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Expander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerReferenceExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestUserTransfer $restUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DocumentRestRequestTransfer
     */
    protected MockObject|DocumentRestRequestTransfer $documentRestRequestTransferMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\CustomerReferenceExpanderPlugin
     */
    protected CustomerReferenceExpanderPlugin $expanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->documentRestRequestTransferMock = $this->getMockBuilder(DocumentRestRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expanderPlugin = new CustomerReferenceExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $idCustomer = 1;

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn($idCustomer);

        $this->documentRestRequestTransferMock->expects(static::atLeastOnce())
            ->method('setCustomerReference')
            ->willReturnSelf();

        static::assertEquals(
            $this->documentRestRequestTransferMock,
            $this->expanderPlugin->expand($this->restRequestMock, $this->documentRestRequestTransferMock),
        );
    }
}
