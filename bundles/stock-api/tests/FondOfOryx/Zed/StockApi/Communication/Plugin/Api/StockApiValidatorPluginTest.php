<?php

namespace FondOfOryx\Zed\StockApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\StockApi\Business\StockApiFacade;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiValidationErrorTransfer;

class StockApiValidatorPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiDataTransferMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Communication\Plugin\Api\StockApiValidatorPlugin
     */
    protected $stockApiValidatorPlugin;

    /**
     * @var \FondOfOryx\Zed\StockApi\Business\StockApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $stockApiFacadeMock;

    /**
     * @return void
     */
    public function _before()
    {
        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiValidateErrorTransferMock = $this->getMockBuilder(ApiValidationErrorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiFacadeMock = $this->getMockBuilder(StockApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiValidatorPlugin = new StockApiValidatorPlugin();
    }

    /**
     * @return void
     */
    public function testValidate()
    {
        $this->stockApiFacadeMock->expects($this->atLeastOnce())
            ->method('validate')
            ->willReturn([$this->apiValidateErrorTransferMock]);

        $this->stockApiValidatorPlugin->setFacade($this->stockApiFacadeMock);

        $this->stockApiValidatorPlugin->validate($this->apiDataTransferMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName()
    {
        $resource = $this->stockApiValidatorPlugin->getResourceName();

        $this->assertEquals('stocks', $resource);
    }
}
