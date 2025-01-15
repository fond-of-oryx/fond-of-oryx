<?php

namespace FondOfOryx\Zed\StockApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\StockApi\Business\StockApiFacade;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ApiValidationErrorTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class StockApiValidatorPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Communication\Plugin\Api\StockApiValidatorPlugin
     */
    protected $stockApiValidatorPlugin;

    /**
     * @var \Generated\Shared\Transfer\ApiValidationErrorTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiValidationErrorTransfer|MockObject $apiValidateErrorTransferMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Business\StockApiFacade|\PHPUnit\Framework\MockObject\MockObject
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
