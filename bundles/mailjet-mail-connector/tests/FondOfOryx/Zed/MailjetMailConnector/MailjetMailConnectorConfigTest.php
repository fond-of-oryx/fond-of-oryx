<?php

namespace FondOfOryx\Zed\MailjetMailConnector;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Shared\MailjetMailConnector\MailjetMailConnectorConstants;

class MailjetMailConnectorConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->config = $this->getMockBuilder(MailjetMailConnectorConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetMailjetKey(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_KEY, $key);

                        return '';
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsString($this->config->getMailjetKey());
    }

    /**
     * @return void
     */
    public function testGetMailjetSecret(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_SECRET, $key);

                        return '';
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsString($this->config->getMailjetSecret());
    }

    /**
     * @return void
     */
    public function testGetMailjetConnectionTimeout(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_CONNECTION_TIMEOUT, $key);

                        return 2.0;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsFloat($this->config->getMailjetConnectionTimeout());
    }

    /**
     * @return void
     */
    public function testGetMailjetTimeout(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_TIMEOUT, $key);

                        return 15.0;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsFloat($this->config->getMailjetTimeout());
    }

    /**
     * @return void
     */
    public function testIsMailjetApiCallEnabled(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_API_CALL_ENABLED, $key);

                        return true;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsBool($this->config->isMailjetApiCallEnabled());
    }

    /**
     * @return void
     */
    public function testGetFromEmail(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_FROM_EMAIL, $key);

                        return '';
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsString($this->config->getFromEmail());
    }

    /**
     * @return void
     */
    public function testGetFromName(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_FROM_NAME, $key);

                        return '';
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsString($this->config->getFromName());
    }

    /**
     * @return void
     */
    public function testGetVersion(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_VERSION, $key);

                        return 'v3.1';
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsString($this->config->getVersion());
    }

    /**
     * @return void
     */
    public function testGetDefaultLocale(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_DEFAULT_LOCALE, $key);

                        return 'en_US';
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsString($this->config->getDefaultLocale());
    }

    /**
     * @return void
     */
    public function testGetUrl(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_URL, $key);

                        return '';
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsString($this->config->getUrl());
    }

    /**
     * @return void
     */
    public function testGetSecure(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_SECURE, $key);

                        return true;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsBool($this->config->getSecure());
    }

    /**
     * @return void
     */
    public function testGetSandboxMode(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_SANDBOX_MODE, $key);

                        return false;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsBool($this->config->getSandboxMode());
    }

    /**
     * @return void
     */
    public function testGetTemplateLanguage(): void
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
                        $self->assertSame(MailjetMailConnectorConstants::MAILJET_TEMPLATE_LANGUAGE, $key);

                        return true;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertIsBool($this->config->getTemplateLanguage());
    }

    /**
     * @return void
     */
    public function testGetOrderConfirmationEmailTemplateIdByLocale(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->willReturnOnConsecutiveCalls(
                ['de_DE' => 100, 'en_US' => 200],
            );

        static::assertIsInt($this->config->getOrderConfirmationEmailTemplateIdByLocale('de_DE'));
    }
}
