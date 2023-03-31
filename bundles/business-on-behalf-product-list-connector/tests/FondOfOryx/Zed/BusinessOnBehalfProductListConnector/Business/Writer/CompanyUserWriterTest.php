<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUserWriterTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CompanyUserReaderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserReaderInterface|MockObject $companyUserReaderMock;

    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerReaderInterface $customerReaderMock;

    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface|MockObject $businessOnBehalfFacadeMock;

    /**
     * @var (\Generated\Shared\Transfer\QuoteTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriter
     */
    protected CompanyUserWriter $companyUserWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserReaderMock = $this->getMockBuilder(CompanyUserReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerReaderMock = $this->getMockBuilder(CustomerReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessOnBehalfFacadeMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserWriter = new CompanyUserWriter(
            $this->companyUserReaderMock,
            $this->customerReaderMock,
            $this->businessOnBehalfFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testSetDefaultByQuoteWithValidData(): void
    {
        $idCompanyUser = 1;
        $idCustomer = 1;
        $defaultIdCompanyUser = 2;

        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getIdByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($idCompanyUser);

        $this->customerReaderMock->expects(static::atLeastOnce())
            ->method('getIdByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($idCustomer);

        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getDefaultIdByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($defaultIdCompanyUser);

        $this->businessOnBehalfFacadeMock->expects(static::atLeastOnce())
            ->method('unsetDefaultCompanyUserByCustomer')
            ->with(
                static::callback(
                    static fn (
                        CustomerTransfer $customerTransfer
                    ) => $customerTransfer->getIdCustomer() === $idCustomer
                ),
            );

        $this->businessOnBehalfFacadeMock->expects(static::atLeastOnce())
            ->method('setDefaultCompanyUser')
            ->with(
                static::callback(
                    static fn (
                        CompanyUserTransfer $companyUserTransfer
                    ) => $companyUserTransfer->getIdCompanyUser() === $idCompanyUser
                    && $companyUserTransfer->getFkCustomer() === $idCustomer
                    && $companyUserTransfer->getCustomer()->getIdCustomer() === $idCustomer
                ),
            );

        $this->companyUserWriter->setDefaultByQuote($this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testSetDefaultByQuote(): void
    {
        $idCompanyUser = 1;
        $idCustomer = 1;
        $defaultIdCompanyUser = 1;

        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getIdByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($idCompanyUser);

        $this->customerReaderMock->expects(static::atLeastOnce())
            ->method('getIdByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($idCustomer);

        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getDefaultIdByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($defaultIdCompanyUser);

        $this->businessOnBehalfFacadeMock->expects(static::never())
            ->method('unsetDefaultCompanyUserByCustomer');

        $this->businessOnBehalfFacadeMock->expects(static::never())
            ->method('setDefaultCompanyUser');

        $this->companyUserWriter->setDefaultByQuote($this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testSetDefaultByQuoteWithInvalidData(): void
    {
        $idCompanyUser = null;
        $idCustomer = null;

        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getIdByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($idCompanyUser);

        $this->customerReaderMock->expects(static::atLeastOnce())
            ->method('getIdByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($idCustomer);

        $this->companyUserReaderMock->expects(static::never())
            ->method('getDefaultIdByQuote');

        $this->businessOnBehalfFacadeMock->expects(static::never())
            ->method('unsetDefaultCompanyUserByCustomer');

        $this->businessOnBehalfFacadeMock->expects(static::never())
            ->method('setDefaultCompanyUser');

        $this->companyUserWriter->setDefaultByQuote($this->quoteTransferMock);
    }
}
