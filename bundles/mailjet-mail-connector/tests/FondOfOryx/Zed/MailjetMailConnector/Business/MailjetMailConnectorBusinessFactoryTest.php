<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider\MailjetMailer;
use FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface;

class MailjetMailConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailjetMailConnectorConfig $configMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider\MailjetMailer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailjetMailer $mailjetMailerMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\MailjetMailConnectorBusinessFactory
     */
    protected MailjetMailConnectorBusinessFactory $factory;

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

        $this->factory = new class extends MailjetMailConnectorBusinessFactory {
            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Psr\Log\LoggerInterface
             */
            protected function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return new NullLogger();
            }
        };
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
