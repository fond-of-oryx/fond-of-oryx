<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi;

use Codeception\Test\Unit;
use Spryker\Glue\Kernel\Container;

class ErpDeliveryNotePageSearchRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\ErpDeliveryNotePageSearchRestApiDependencyProvider
     */
    protected $ErpDeliveryNotePageSearchRestApiDependencyProvider;

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

        $this->ErpDeliveryNotePageSearchRestApiDependencyProvider = new ErpDeliveryNotePageSearchRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->ErpDeliveryNotePageSearchRestApiDependencyProvider->provideDependencies(
                $this->containerMock,
            ),
        );
    }
}
