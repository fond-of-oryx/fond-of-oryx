<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientBridge;
use FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStub;
use FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStubInterface;
use Spryker\Client\Kernel\Container;

class ReturnLabelsRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelsRestApiToZedRequestClientBridgeMock;

    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelsRestApiZedStub;

    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelsRestApiToZedRequestClientBridgeMock = $this->getMockBuilder(ReturnLabelsRestApiToZedRequestClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelsRestApiZedStub = $this->getMockBuilder(ReturnLabelsRestApiZedStub::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ReturnLabelsRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateReturnLabelZedStub(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case ReturnLabelsRestApiDependencyProvider::CLIENT_ZED_REQUEST:
                        return $self->returnLabelsRestApiToZedRequestClientBridgeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            ReturnLabelsRestApiZedStubInterface::class,
            $this->factory->createReturnLabelZedStub(),
        );
    }
}
