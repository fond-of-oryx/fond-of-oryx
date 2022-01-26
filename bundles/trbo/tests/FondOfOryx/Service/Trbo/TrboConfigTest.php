<?php

namespace FondOfOryx\Service\Trbo;

use Codeception\Test\Unit;
use FondOfOryx\Shared\Trbo\TrboConstants;

class TrboConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Service\Trbo\TrboConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->config = $this->getMockBuilder(TrboConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetTrboApiShopId(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(TrboConstants::TRBO_API_SHOP_ID, '')
            ->willReturn('');

        static::assertEquals('', $this->config->getTrboApiShopId());
    }

    /**
     * @return void
     */
    public function testGetTrboApiClientId(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(TrboConstants::TRBO_API_CLIENT_ID, '')
            ->willReturn('');

        static::assertEquals('', $this->config->getTrboApiClientId());
    }

    /**
     * @return void
     */
    public function testGetTrboApiKey(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(TrboConstants::TRBO_API_KEY, '')
            ->willReturn('');

        static::assertEquals('', $this->config->getTrboApiKey());
    }

    /**
     * @return void
     */
    public function testGetTrboApiUrl(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(TrboConstants::TRBO_API_URL, '')
            ->willReturn('');

        static::assertEquals('', $this->config->getTrboApiUrl());
    }

    /**
     * @return void
     */
    public function testGetTrboApiTimeout(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(TrboConstants::TRBO_API_TIMEOUT, TrboConstants::TRBO_API_FALLBACK_TIMEOUT)
            ->willReturn(TrboConstants::TRBO_API_FALLBACK_TIMEOUT);

        static::assertEquals(TrboConstants::TRBO_API_FALLBACK_TIMEOUT, $this->config->getTrboApiTimeout());
    }

    /**
     * @return void
     */
    public function testIsHttpErrorsEnabledReturnFalse(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(TrboConstants::TRBO_API_HTTP_ERRORS, false)
            ->willReturn(false);

        static::assertFalse($this->config->isHttpErrorsEnabled());
    }

    /**
     * @return void
     */
    public function testIsHttpErrorsEnabledReturnTrue(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(TrboConstants::TRBO_API_HTTP_ERRORS, false)
            ->willReturn(true);

        static::assertTrue($this->config->isHttpErrorsEnabled());
    }
}
