<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Expander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class IdExpanderPluginTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request
     */
    protected MockObject|Request $requestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\ParameterBag
     */
    protected MockObject|ParameterBag $parameterBagMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\IdExpanderPlugin
     */
    protected IdExpanderPlugin $expanderPlugin;

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

        $this->requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->parameterBagMock = $this->getMockBuilder(ParameterBag::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expanderPlugin = new IdExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $idCustomer = 1;

        $this->requestMock->query = $this->parameterBagMock;

        $this->documentRestRequestTransferMock->expects(static::atLeastOnce())
            ->method('setId')
            ->willReturnSelf();

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->requestMock);

        $this->parameterBagMock->expects(static::atLeastOnce())
            ->method('get')
            ->with('id')
            ->willReturn($idCustomer);

        static::assertEquals(
            $this->documentRestRequestTransferMock,
            $this->expanderPlugin->expand($this->restRequestMock, $this->documentRestRequestTransferMock),
        );
    }
}
