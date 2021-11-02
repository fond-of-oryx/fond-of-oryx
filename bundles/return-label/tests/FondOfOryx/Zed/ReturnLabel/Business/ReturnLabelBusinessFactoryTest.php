<?php

namespace FondOfOryx\Zed\ReturnLabel\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGenerator;
use FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceBridge;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ReturnLabelBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelToUtilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelBusinessFactory
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

        $this->configMock = $this->getMockBuilder(ReturnLabelConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelToUtilEncodingServiceMock = $this->getMockBuilder(ReturnLabelToUtilEncodingServiceBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ReturnLabelBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateReturnLabelGenerator(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([ReturnLabelDependencyProvider::SERVICE_UTIL_ENCODING])
            ->willReturnOnConsecutiveCalls($this->returnLabelToUtilEncodingServiceMock);

        static::assertInstanceOf(
            ReturnLabelGenerator::class,
            $this->factory->createReturnLabelGenerator(),
        );
    }
}
