<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client;

use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;

class OrderBudgetSearchRestApiToGlossaryStorageClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|GlossaryStorageClientInterface $clientMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientBridge
     */
    protected OrderBudgetSearchRestApiToGlossaryStorageClientBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(GlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new OrderBudgetSearchRestApiToGlossaryStorageClientBridge($this->clientMock);
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $locale = 'de_DE';
        $untranslated = 'x.x.x';
        $parameters = [];
        $translated = 'x';

        $this->clientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($untranslated, $locale, $parameters)
            ->willReturn($translated);

        static::assertEquals(
            $translated,
            $this->bridge->translate($untranslated, $locale, $parameters),
        );
    }
}
