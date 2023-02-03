<?php

namespace FondOfOryx\Zed\ErpOrderApi\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderApi\Business\ErpOrderApiFacade;
use FondOfOryx\Zed\ErpOrderApi\Communication\Plugin\Api\ErpOrderApiValidatorPlugin;
use FondOfOryx\Zed\ErpOrderApi\ErpOrderApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpOrderApiValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Communication\Plugin\Api\ErpOrderApiValidatorPlugin
     */
    protected $erpOrderApiValidatorPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderApi\Business\ErpOrderApiFacade
     */
    protected $erpOrderApiFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpOrderApiFacadeMock = $this->getMockBuilder(ErpOrderApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderApiValidatorPlugin = new ErpOrderApiValidatorPlugin();
        $this->erpOrderApiValidatorPlugin->setFacade($this->erpOrderApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertSame(
            ErpOrderApiConfig::RESOURCE_ERP_ORDERS,
            $this->erpOrderApiValidatorPlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $validationResult = [];

        $this->erpOrderApiFacadeMock->expects(static::atLeastOnce())
            ->method('validateErpOrder')
            ->with($this->apiRequestTransferMock)
            ->willReturn($validationResult);

        static::assertEquals(
            $validationResult,
            $this->erpOrderApiValidatorPlugin->validate(
                $this->apiRequestTransferMock,
            ),
        );
    }
}
