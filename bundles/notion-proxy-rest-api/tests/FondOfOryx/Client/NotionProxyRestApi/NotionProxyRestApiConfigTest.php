<?php

namespace FondOfOryx\Client\NotionProxyRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Shared\NotionProxyRestApi\NotionProxyRestApiConfig as SharedConfig;
use PHPUnit\Framework\MockObject\MockObject;

class NotionProxyRestApiConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiConfig
     */
    protected NotionProxyRestApiConfig $config;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiConfig
     */
    protected MockObject|NotionProxyRestApiConfig $sharedConfigMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->sharedConfigMock = $this->getMockBuilder(SharedConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->config = new NotionProxyRestApiConfig();
        $this->config->setSharedConfig($this->sharedConfigMock);
    }

    /**
     * @return void
     */
    public function testGetClientConfig(): void
    {
        $this->sharedConfigMock->expects(static::atLeastOnce())
            ->method('getClientConfig')
            ->willReturn([]);

        $clientConfig = $this->config->getClientConfig();

        static::assertIsArray($clientConfig);
        static::assertEquals([], $clientConfig);
    }
}
