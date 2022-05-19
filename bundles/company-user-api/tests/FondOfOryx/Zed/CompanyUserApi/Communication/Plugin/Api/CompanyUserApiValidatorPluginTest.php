<?php

namespace FondOfOryx\Zed\CompanyUserApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserApi\Business\CompanyUserApiFacade;
use FondOfOryx\Zed\CompanyUserApi\CompanyUserApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyUserApiValidatorPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserApi\Business\CompanyUserApiFacade
     */
    protected $companyUserApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserApi\Communication\Plugin\Api\CompanyUserApiValidatorPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserApiFacadeMock = $this->getMockBuilder(CompanyUserApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUserApiValidatorPlugin();
        $this->plugin->setFacade($this->companyUserApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(CompanyUserApiConfig::RESOURCE_COMPANY_USERS, $this->plugin->getResourceName());
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->companyUserApiFacadeMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn([]);

        static::assertCount(0, $this->plugin->validate($this->apiDataTransferMock));
    }
}
