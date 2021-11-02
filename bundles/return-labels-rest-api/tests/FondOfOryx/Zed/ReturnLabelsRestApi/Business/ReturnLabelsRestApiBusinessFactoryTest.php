<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGenerator;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeBridge;
use FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ReturnLabelsRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\ReturnLabelsRestApiBusinessFactory
     */
    protected $returnLabelsRestApiBusinessFactory;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelGeneratorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->returnLabelFacadeMock = $this->getMockBuilder(ReturnLabelsRestApiToReturnLabelFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelGeneratorMock = $this->getMockBuilder(ReturnLabelGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelsRestApiBusinessFactory = new ReturnLabelsRestApiBusinessFactory();
        $this->returnLabelsRestApiBusinessFactory->setContainer($this->containerMock);
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
            ->withConsecutive(
                [ReturnLabelsRestApiDependencyProvider::FACADE_RETURN_LABEL],
                [ReturnLabelsRestApiDependencyProvider::PLUGINS_RETURN_LABEL_REQUEST_EXPANDER],
            )->willReturnOnConsecutiveCalls($this->returnLabelFacadeMock, []);

        static::assertInstanceOf(
            ReturnLabelGenerator::class,
            $this->returnLabelsRestApiBusinessFactory->createReturnLabelGenerator(),
        );
    }
}
