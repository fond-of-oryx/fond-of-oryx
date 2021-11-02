<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;

class CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(GlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientBridge($this->glossaryStorageClientMock);
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

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($untranslated, $locale, $parameters)
            ->willReturn($translated);

        static::assertEquals(
            $translated,
            $this->bridge->translate($untranslated, $locale, $parameters),
        );
    }
}
