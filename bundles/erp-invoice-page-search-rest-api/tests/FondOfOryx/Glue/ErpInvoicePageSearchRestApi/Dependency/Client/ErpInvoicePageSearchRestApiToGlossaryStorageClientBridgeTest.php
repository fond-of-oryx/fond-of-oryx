<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;

class ErpInvoicePageSearchRestApiToGlossaryStorageClientBridgeTest extends Unit
{
    /**
     * @var \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this
            ->getMockBuilder(GlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ErpInvoicePageSearchRestApiToGlossaryStorageClientBridge($this->clientMock);
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $id = 'foo';
        $localeName = 'de_DE';
        $parameters = [];
        $translatedValue = 'Foo';

        $this->clientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($id, $localeName, $parameters)
            ->willReturn($translatedValue);

        static::assertEquals(
            $translatedValue,
            $this->bridge->translate($id, $localeName, $parameters),
        );
    }
}
