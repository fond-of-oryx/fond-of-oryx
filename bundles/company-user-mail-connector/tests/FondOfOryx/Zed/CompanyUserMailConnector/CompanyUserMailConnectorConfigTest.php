<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyUserMailConnector\CompanyUserMailConnectorConstants;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUserMailConnectorConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserMailConnectorConfig|MockObject $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->config = $this->getMockBuilder(CompanyUserMailConnectorConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetRolesToInformAbout(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                CompanyUserMailConnectorConstants::ROLES_TO_INFORM_ABOUT_LIST,
                CompanyUserMailConnectorConstants::ROLES_TO_INFORM_ABOUT_LIST_DEFAULT,
            )->willReturn(
                CompanyUserMailConnectorConstants::ROLES_TO_INFORM_ABOUT_LIST_DEFAULT,
            );

        static::assertEquals(
            CompanyUserMailConnectorConstants::ROLES_TO_INFORM_ABOUT_LIST_DEFAULT,
            $this->config->getRolesToInformAbout(),
        );
    }

    /**
     * @return void
     */
    public function testGetRolesToNotify(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                CompanyUserMailConnectorConstants::ROLES_TO_NOTIFY,
                CompanyUserMailConnectorConstants::ROLES_TO_NOTIFY_DEFAULT,
            )->willReturn(
                CompanyUserMailConnectorConstants::ROLES_TO_NOTIFY_DEFAULT,
            );

        static::assertEquals(
            CompanyUserMailConnectorConstants::ROLES_TO_NOTIFY_DEFAULT,
            $this->config->getRolesToNotify(),
        );
    }
}
