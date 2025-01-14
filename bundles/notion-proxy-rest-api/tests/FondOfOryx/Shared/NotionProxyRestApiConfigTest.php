<?php

namespace FondOfOryx\Shared\NotionProxyRestApi;

use Codeception\Test\Unit;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;

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
        $self = $this;

        $callCount = $this->atLeastOnce();
        $this->config->expects($callCount)
            ->method('get')
            ->willReturnCallback(static function ($key, $default = null) use ($self, $callCount) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame(NotionProxyRestApiConstants::AUTH_HEADER, $key);

                        return 'authentication';
                    case 2:
                        $self->assertSame(NotionProxyRestApiConstants::NOTION_VERSION_HEADER, $key);

                        return 'version';
                    case 3:
                        $self->assertSame(NotionProxyRestApiConstants::BASE_URI, $key);

                        return 'base_uri';
                }

                throw new Exception('Unexpected call count');
            });

            static::assertIsArray($this->config->getClientConfig());
    }
}
