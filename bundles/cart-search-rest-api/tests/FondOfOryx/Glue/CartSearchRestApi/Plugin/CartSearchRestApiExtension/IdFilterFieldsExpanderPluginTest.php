<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Plugin\CartSearchRestApiExtension;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiFactory;
use FondOfOryx\Glue\CartSearchRestApi\Dependency\Service\CartSearchRestApiToUtilEncodingServiceInterface;
use FondOfOryx\Shared\CartSearchRestApi\CartSearchRestApiConstants;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class IdFilterFieldsExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected MockObject|RestRequestInterface $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request
     */
    protected MockObject|Request $httpRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|RestResourceInterface $restResourceMock;

    /**
     * @var \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    protected ArrayObject $filterFieldTransfers;

    /**
     * @var (\FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiFactory&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CartSearchRestApiFactory|MockObject $factoryMock;

    /**
     * @var (\FondOfOryx\Glue\CartSearchRestApi\Dependency\Service\CartSearchRestApiToUtilEncodingServiceInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CartSearchRestApiToUtilEncodingServiceInterface $utilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Plugin\CartSearchRestApiExtension\IdFilterFieldsExpanderPlugin
     */
    protected IdFilterFieldsExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->httpRequestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransfers = new ArrayObject();

        $this->factoryMock = $this->getMockBuilder(CartSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilEncodingServiceMock = $this->getMockBuilder(CartSearchRestApiToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new IdFilterFieldsExpanderPlugin();
        $this->plugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $uuids = ['foo', 'bar'];
        $uuidsAsJson = json_encode($uuids);
        $this->httpRequestMock->query = new ParameterBag([CartSearchRestApiConstants::PARAMETER_NAME_ID => $uuids]);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn(null);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->httpRequestMock);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getUtilEncodingService')
            ->willReturn($this->utilEncodingServiceMock);

        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->with($uuids)
            ->willReturn($uuidsAsJson);

        $filterFieldTransfers = $this->plugin->expand($this->restRequestMock, $this->filterFieldTransfers);

        static::assertCount(1, $filterFieldTransfers);

        $filterFieldTransfer = $filterFieldTransfers->offsetGet(0);

        static::assertEquals(CartSearchRestApiConstants::FILTER_FIELD_TYPE_UUIDS, $filterFieldTransfer->getType());
        static::assertEquals($uuidsAsJson, $filterFieldTransfer->getValue());
    }

    /**
     * @return void
     */
    public function testExpandWithResourceId(): void
    {
        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn('foo');

        $this->restRequestMock->expects(static::never())
            ->method('getHttpRequest');

        $this->factoryMock->expects(static::never())
            ->method('getUtilEncodingService');

        $filterFieldTransfers = $this->plugin->expand($this->restRequestMock, $this->filterFieldTransfers);

        static::assertCount(0, $filterFieldTransfers);
    }
}
