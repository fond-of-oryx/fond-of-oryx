<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector;

use Codeception\Test\Unit;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery;
use Spryker\Zed\Kernel\Container;

class CreditMemoGiftCardConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\CreditMemoGiftCardConnectorDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $containerMock = $this->getMockBuilder(Container::class);

        /** @phpstan-ignore-next-line */
        if (method_exists($containerMock, 'setMethodsExcept')) {
            /** @phpstan-ignore-next-line */
            $containerMock->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet']);
        } else {
            /** @phpstan-ignore-next-line */
            $containerMock->onlyMethods(['getLocator'])->enableOriginalClone();
        }

        $this->containerMock = $containerMock->getMock();

        $this->dependencyProvider = new CreditMemoGiftCardConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testPersistenceLayerDependencies(): void
    {
        $container = $this->dependencyProvider
            ->providePersistenceLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            FooCreditMemoQuery::class,
            $container[CreditMemoGiftCardConnectorDependencyProvider::QUERY_FOO_CREDIT_MEMO],
        );
    }
}
