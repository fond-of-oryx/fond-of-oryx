<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Exporter\SalesOrderExporter;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig;
use FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\JellyfishSalesOrderBusinessFactory
     */
    protected $jellyfishSalesOrderBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig
     */
    protected $jellyfishSalesOrderConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceInterface
     */
    protected $jellyfishSalesOrderToUtilEncodingServiceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishSalesOrderToUtilEncodingServiceMock = $this->getMockBuilder(JellyfishSalesOrderToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishSalesOrderConfigMock = $this->getMockBuilder(JellyfishSalesOrderConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishSalesOrderBusinessFactory = new JellyfishSalesOrderBusinessFactory();
        $this->jellyfishSalesOrderBusinessFactory->setConfig($this->jellyfishSalesOrderConfigMock);
        $this->jellyfishSalesOrderBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateSalesOrderExporter(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_ADDRESS_EXPANDER_POST_MAP],
                [JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_EXPANDER_POST_MAP],
                [JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_ITEM_EXPANDER_POST_MAP],
                [JellyfishSalesOrderDependencyProvider::SERVICE_UTIL_ENCODING],
                [JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_BEFORE_EXPORT]
            )->willReturnOnConsecutiveCalls(
                [],
                [],
                [],
                $this->jellyfishSalesOrderToUtilEncodingServiceMock,
                []
            );

        $this->jellyfishSalesOrderConfigMock->expects($this->atLeastOnce())
            ->method('getSystemCode')
            ->willReturn('');

        $this->assertInstanceOf(
            SalesOrderExporter::class,
            $this->jellyfishSalesOrderBusinessFactory->createSalesOrderExporter()
        );
    }
}
