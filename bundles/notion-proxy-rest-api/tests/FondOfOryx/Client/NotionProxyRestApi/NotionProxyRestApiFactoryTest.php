<?php

namespace FondOfOryx\Client\NotionProxyRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\NotionProxyRestApi\Request\RequestInterface;
use PHPUnit\Framework\MockObject\MockObject;

class NotionProxyRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiConfig
     */
    protected MockObject|NotionProxyRestApiConfig $configMock;

    /**
     * @var \FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiFactory
     */
    protected NotionProxyRestApiFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(NotionProxyRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new NotionProxyRestApiFactory();
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateClient(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getClientConfig')
            ->willReturn([]);

        static::assertInstanceOf(
            RequestInterface::class,
            $this->factory->createRequestClient(),
        );
    }
}
