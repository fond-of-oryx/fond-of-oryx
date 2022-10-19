<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi;

use Codeception\Test\Unit;
use Spryker\Glue\Kernel\Container;

class ErpInvoicePageSearchRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\ErpInvoicePageSearchRestApiDependencyProvider
     */
    protected $ErpInvoicePageSearchRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ErpInvoicePageSearchRestApiDependencyProvider = new ErpInvoicePageSearchRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->ErpInvoicePageSearchRestApiDependencyProvider->provideDependencies(
                $this->containerMock,
            ),
        );
    }
}
