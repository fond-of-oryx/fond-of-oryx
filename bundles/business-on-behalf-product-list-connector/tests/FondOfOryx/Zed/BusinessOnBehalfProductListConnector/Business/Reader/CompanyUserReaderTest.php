<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepositoryInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUserReaderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfProductListConnectorRepositoryInterface|MockObject $repositoryMock;

    /**
     * @var (\Generated\Shared\Transfer\QuoteTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CompanyUserReader
     */
    protected CompanyUserReader $companyUserReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReader = new CompanyUserReader(
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetIdByQuote(): void
    {
        $idCompanyUser = 1;
        $companyUserReference = 'FOO';

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($companyUserReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUserByCompanyUserReference')
            ->with($companyUserReference)
            ->willReturn($idCompanyUser);

        static::assertEquals(
            $idCompanyUser,
            $this->companyUserReader->getIdByQuote($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetIdByQuoteWithoutCompanyUserReference(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn(null);

        $this->repositoryMock->expects(static::never())
            ->method('getIdCompanyUserByCompanyUserReference');

        static::assertEquals(
            null,
            $this->companyUserReader->getIdByQuote($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetDefaultIdByQuote(): void
    {
        $idCompanyUser = 1;
        $customerReference = 'FOO';

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getDefaultIdCompanyUserByCustomerReference')
            ->with($customerReference)
            ->willReturn($idCompanyUser);

        static::assertEquals(
            $idCompanyUser,
            $this->companyUserReader->getDefaultIdByQuote($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetDefaultIdByQuoteWithoutCustomerReference(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn(null);

        $this->repositoryMock->expects(static::never())
            ->method('getDefaultIdCompanyUserByCustomerReference');

        static::assertEquals(
            null,
            $this->companyUserReader->getDefaultIdByQuote($this->quoteTransferMock),
        );
    }
}
