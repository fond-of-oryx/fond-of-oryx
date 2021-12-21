<?php


namespace FondOfOryx\Zed\CompanyApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyApi\Business\CompanyApiFacade;
use FondOfOryx\Zed\CompanyApi\CompanyApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyApiValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyApi\Communication\Plugin\Api\CompanyApiValidatorPlugin
     */
    protected $companyApiValidatorPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyApi\Business\CompanyApiFacade
     */
    protected $companyApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyApiFacadeMock = $this->getMockBuilder(CompanyApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyApiValidatorPlugin = new CompanyApiValidatorPlugin();

        $this->companyApiValidatorPlugin->setFacade($this->companyApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertSame(CompanyApiConfig::RESOURCE_COMPANIES, $this->companyApiValidatorPlugin->getResourceName());
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $errors = [];

        $this->companyApiFacadeMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn($errors);

        static::assertEquals($errors, $this->companyApiValidatorPlugin->validate($this->apiDataTransferMock));
    }
}
