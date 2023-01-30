<?php

namespace FondOfOryx\Zed\InvoiceApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\InvoiceApi\Business\InvoiceApiFacade;
use FondOfOryx\Zed\InvoiceApi\InvoiceApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;

class InvoiceApiValidatorPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\InvoiceApi\Business\InvoiceApiFacade
     */
    protected $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\InvoiceApi\Communication\Plugin\Api\InvoiceApiValidatorPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(InvoiceApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new InvoiceApiValidatorPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(InvoiceApiConfig::RESOURCE_INVOICE, $this->plugin->getResourceName());
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiRequestTransferMock)
            ->willReturn([]);

        static::assertEquals([], $this->plugin->validate($this->apiRequestTransferMock));
    }
}
