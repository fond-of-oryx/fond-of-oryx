<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\CompanyTypeProductListsRestApiFacade;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class CompanyTypeRestProductListUpdateRequestExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\CompanyTypeProductListsRestApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension\CompanyTypeRestProductListUpdateRequestExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyTypeProductListsRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyTypeRestProductListUpdateRequestExpanderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandRestProductListUpdateRequest')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn($this->restProductListUpdateRequestTransferMock);

        static::assertEquals(
            $this->restProductListUpdateRequestTransferMock,
            $this->plugin->expand($this->restProductListUpdateRequestTransferMock),
        );
    }
}
