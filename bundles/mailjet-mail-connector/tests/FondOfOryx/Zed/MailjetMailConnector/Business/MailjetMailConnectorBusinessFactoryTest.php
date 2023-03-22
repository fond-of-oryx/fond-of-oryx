<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider\MailjetMailer;
use FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface;

class MailjetMailConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider\MailjetMailer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailjetMailerMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\MailjetMailConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(MailjetMailConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailjetMailerMock = $this->getMockBuilder(MailjetMailer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new MailjetMailConnectorBusinessFactory();
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateMailjetMailer(): void
    {
        static::assertInstanceOf(MailProviderPluginInterface::class, $this->factory->createMailjetMailer());
    }
}
