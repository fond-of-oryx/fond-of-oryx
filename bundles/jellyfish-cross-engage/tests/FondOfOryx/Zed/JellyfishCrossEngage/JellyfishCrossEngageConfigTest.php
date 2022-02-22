<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage;

use Codeception\Test\Unit;
use FondOfOryx\Shared\JellyfishCrossEngage\JellyfishCrossEngageConstants;

class JellyfishCrossEngageConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->config = $this->getMockBuilder(JellyfishCrossEngageConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetDefaultLocaleName(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(JellyfishCrossEngageConstants::DEFAULT_LOCALE_NAME, 'en_US')
            ->willReturn('en_US');

        static::assertSame(
            'en_US',
            $this->config->getDefaultLocaleName(),
        );
    }
}
