<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade;
use FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyBusinessUnitApiValidatorPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade
     */
    protected $companyBusinessUnitApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Communication\Plugin\Api\CompanyBusinessUnitApiValidatorPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitApiFacadeMock = $this->getMockBuilder(CompanyBusinessUnitApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyBusinessUnitApiValidatorPlugin();
        $this->plugin->setFacade($this->companyBusinessUnitApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(
            CompanyBusinessUnitApiConfig::RESOURCE_COMPANY_BUSINESS_UNITS,
            $this->plugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $errors = [];

        $this->companyBusinessUnitApiFacadeMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiRequestTransferMock)
            ->willReturn($errors);

        static::assertEquals(
            $errors,
            $this->plugin->validate($this->apiRequestTransferMock),
        );
    }
}
