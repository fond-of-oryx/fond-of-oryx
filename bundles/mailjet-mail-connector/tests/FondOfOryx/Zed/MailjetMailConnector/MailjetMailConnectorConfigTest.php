<?php

namespace FondOfOryx\Zed\MailjetMailConnector;

use Codeception\Test\Unit;
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
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_KEY])
            ->willReturnOnConsecutiveCalls('');

        static::assertIsString($this->config->getMailjetKey());
    }

    /**
     * @return void
     */
    public function testGetMailjetSecret(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_SECRET])
            ->willReturnOnConsecutiveCalls('');

        static::assertIsString($this->config->getMailjetSecret());
    }

    /**
     * @return void
     */
    public function testGetMailjetConnectionTimeout(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_CONNECTION_TIMEOUT])
            ->willReturnOnConsecutiveCalls(2.0);

        static::assertIsFloat($this->config->getMailjetConnectionTimeout());
    }

    /**
     * @return void
     */
    public function testGetMailjetTimeout(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_TIMEOUT])
            ->willReturnOnConsecutiveCalls(15.0);

        static::assertIsFloat($this->config->getMailjetTimeout());
    }

    /**
     * @return void
     */
    public function testIsMailjetApiCallEnabled(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_API_CALL_ENABLED])
            ->willReturnOnConsecutiveCalls(true);

        static::assertIsBool($this->config->isMailjetApiCallEnabled());
    }

    /**
     * @return void
     */
    public function testGetFromEmail(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_FROM_EMAIL])
            ->willReturnOnConsecutiveCalls('');

        static::assertIsString($this->config->getFromEmail());
    }

    /**
     * @return void
     */
    public function testGetFromName(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_FROM_NAME])
            ->willReturnOnConsecutiveCalls('');

        static::assertIsString($this->config->getFromName());
    }

    /**
     * @return void
     */
    public function testGetVersion(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_VERSION])
            ->willReturnOnConsecutiveCalls('v3.1');

        static::assertIsString($this->config->getVersion());
    }

    /**
     * @return void
     */
    public function testGetDefaultLocale(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_DEFAULT_LOCALE])
            ->willReturnOnConsecutiveCalls('en_US');

        static::assertIsString($this->config->getDefaultLocale());
    }

    /**
     * @return void
     */
    public function testGetUrl(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_URL])
            ->willReturnOnConsecutiveCalls('');

        static::assertIsString($this->config->getUrl());
    }

    /**
     * @return void
     */
    public function testGetSecure(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_SECURE])
            ->willReturnOnConsecutiveCalls(true);

        static::assertIsBool($this->config->getSecure());
    }

    /**
     * @return void
     */
    public function testGetSandboxMode(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_SANDBOX_MODE])
            ->willReturnOnConsecutiveCalls(false);

        static::assertIsBool($this->config->getSandboxMode());
    }

    /**
     * @return void
     */
    public function testGetTemplateLanguage(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([MailjetMailConnectorConstants::MAILJET_TEMPLATE_LANGUAGE])
            ->willReturnOnConsecutiveCalls(true);

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
