<?php

namespace FondOfOryx\Shared\NotionProxyRestApi;

use Codeception\Test\Unit;

class NotionProxyRestApiConfigTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Shared\NotionProxyRestApi\NotionProxyRestApiConfig
     */
    protected MockObject|NotionProxyRestApiConfig $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->config = $this->getMockBuilder(NotionProxyRestApiConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetClientConfig(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [NotionProxyRestApiConstants::AUTH_HEADER],
                [NotionProxyRestApiConstants::NOTION_VERSION_HEADER],
                [NotionProxyRestApiConstants::BASE_URI],
            )->willReturnOnConsecutiveCalls(
                'authentication',
                'version',
                'base_uri',
            );

            static::assertIsArray($this->config->getClientConfig());
    }
}
