<?php

namespace FondOfOryx\Zed\SplittableCheckoutCompanyUserConnector\Communication\Plugin\SplittableCheckoutExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CompanyUserIdentifierExtractorPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutCompanyUserConnector\Communication\Plugin\SplittableCheckoutExtension\CompanyUserIdentifierExtractorPlugin
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

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUserIdentifierExtractorPlugin();
    }

    /**
     * @return void
     */
    public function testExtract(): void
    {
        $identifier = 1;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUser')
            ->willReturn($identifier);

        static::assertEquals(
            $identifier,
            $this->plugin->extract($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExtractWithNullableCompanyUser(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn(null);

        static::assertEquals(
            null,
            $this->plugin->extract($this->quoteTransferMock),
        );
    }
}
