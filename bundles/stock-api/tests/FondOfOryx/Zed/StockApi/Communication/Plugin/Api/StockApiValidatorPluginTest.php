<?php

namespace FondOfOryx\Zed\StockApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\StockApi\Business\StockApiFacade;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ApiValidationErrorTransfer;

class StockApiValidatorPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Communication\Plugin\Api\StockApiValidatorPlugin
     */
    protected $stockApiValidatorPlugin;

    /**
     * @var \FondOfOryx\Zed\StockApi\Business\StockApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $facadeMock;

    /**
     * @return void
     */
    public function _before(): void
    {
        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiValidateErrorTransferMock = $this->getMockBuilder(ApiValidationErrorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(StockApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiValidatorPlugin = new StockApiValidatorPlugin();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->facadeMock->expects($this->atLeastOnce())
            ->method('validate')
            ->willReturn([$this->apiValidateErrorTransferMock]);

        $this->stockApiValidatorPlugin->setFacade($this->facadeMock);

        $this->stockApiValidatorPlugin->validate($this->apiRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        $resource = $this->stockApiValidatorPlugin->getResourceName();

        $this->assertEquals('stocks', $resource);
    }
}
