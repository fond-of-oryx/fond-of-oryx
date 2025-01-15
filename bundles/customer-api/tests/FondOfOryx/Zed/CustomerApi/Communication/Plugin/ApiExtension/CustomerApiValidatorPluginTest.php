<?php


namespace FondOfOryx\Zed\CustomerApi\Communication\Plugin\ApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerApi\Business\CustomerApiFacade;
use FondOfOryx\Zed\CustomerApi\CustomerApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CustomerApiValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerApi\Business\CustomerApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerApiFacade|MockObject $customerApiFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiRequestTransfer|MockObject $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Communication\Plugin\ApiExtension\CustomerApiValidatorPlugin
     */
    protected CustomerApiValidatorPlugin $customerApiValidatorPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerApiFacadeMock = $this->getMockBuilder(CustomerApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerApiValidatorPlugin = new CustomerApiValidatorPlugin();
        $this->customerApiValidatorPlugin->setFacade($this->customerApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertSame(CustomerApiConfig::RESOURCE_CUSTOMERS, $this->customerApiValidatorPlugin->getResourceName());
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $errors = [];

        $this->customerApiFacadeMock->expects(static::atLeastOnce())
            ->method('validateApiRequest')
            ->with($this->apiRequestTransferMock)
            ->willReturn($errors);

        static::assertEquals($errors, $this->customerApiValidatorPlugin->validate($this->apiRequestTransferMock));
    }
}
