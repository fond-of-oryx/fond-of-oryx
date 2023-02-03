<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacade;
use FondOfOryx\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUnitAddressApiValidatorPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacadeInterface
     */
    protected $companyUnitAddressApiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Communication\Plugin\Api\CompanyUnitAddressApiValidatorPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiFacadeMock = $this->getMockBuilder(CompanyUnitAddressApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUnitAddressApiValidatorPlugin();
        $this->plugin->setFacade($this->companyUnitAddressApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(
            CompanyUnitAddressApiConfig::RESOURCE_COMPANY_UNIT_ADDRESSES,
            $this->plugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $errors = [];

        $this->companyUnitAddressApiFacadeMock->expects($this->atLeastOnce())
            ->method('validate')
            ->with($this->apiRequestTransferMock)
            ->willReturn($errors);

        static::assertEquals(
            $errors,
            $this->plugin->validate($this->apiRequestTransferMock),
        );
    }
}
