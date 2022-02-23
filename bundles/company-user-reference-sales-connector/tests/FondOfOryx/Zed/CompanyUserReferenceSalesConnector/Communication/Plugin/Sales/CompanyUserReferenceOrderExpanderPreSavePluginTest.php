<?php

namespace FondOfOryx\Zed\CompanyUserReferenceSalesConnector\Communication\Plugin\Sales;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;

class CompanyUserReferenceOrderExpanderPreSavePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SpySalesOrderEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderEntityTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserReferenceSalesConnector\Communication\Plugin\Sales\CompanyUserReferenceOrderExpanderPreSavePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderEntityTransferMock = $this->getMockBuilder(SpySalesOrderEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUserReferenceOrderExpanderPreSavePlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $companyUserReference = 'FOO--CU-1';

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($companyUserReference);

        $this->spySalesOrderEntityTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyUserReference')
            ->with($companyUserReference)
            ->willReturn($this->spySalesOrderEntityTransferMock);

        static::assertEquals(
            $this->spySalesOrderEntityTransferMock,
            $this->plugin->expand(
                $this->spySalesOrderEntityTransferMock,
                $this->quoteTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithEmptyCompanyUserReference(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn(null);

        $this->spySalesOrderEntityTransferMock->expects(static::never())
            ->method('setCompanyUserReference');

        static::assertEquals(
            $this->spySalesOrderEntityTransferMock,
            $this->plugin->expand(
                $this->spySalesOrderEntityTransferMock,
                $this->quoteTransferMock,
            ),
        );
    }
}
