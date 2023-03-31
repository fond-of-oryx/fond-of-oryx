<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepositoryInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CustomerReaderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfProductListConnectorToCustomerFacadeInterface $customerFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfProductListConnectorRepositoryInterface|MockObject $repositoryMock;

    /**
     * @var (\Generated\Shared\Transfer\QuoteTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\CustomerTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReader
     */
    protected CustomerReader $customerReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerFacadeMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorToCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerReader = new CustomerReader(
            $this->customerFacadeMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByQuote(): void
    {
        $idCustomer = 1;
        $customerReference = 'FOO';

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByCustomerReference')
            ->with($customerReference)
            ->willReturn($idCustomer);

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('findCustomerById')
            ->with(
                static::callback(
                    static fn (
                        CustomerTransfer $customerTransfer
                    ) => $customerTransfer->getIdCustomer() === $idCustomer
                ),
            )->willReturn($this->customerTransferMock);

        static::assertEquals(
            $this->customerTransferMock,
            $this->customerReader->getByQuote($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetByQuoteWithoutIdCustomer(): void
    {
        $idCustomer = null;
        $customerReference = 'FOO';

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByCustomerReference')
            ->with($customerReference)
            ->willReturn($idCustomer);

        $this->customerFacadeMock->expects(static::never())
            ->method('findCustomerById');

        static::assertEquals(
            null,
            $this->customerReader->getByQuote($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetIdByQuote(): void
    {
        $idCustomer = 1;
        $customerReference = 'FOO';

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByCustomerReference')
            ->with($customerReference)
            ->willReturn($idCustomer);

        static::assertEquals(
            $idCustomer,
            $this->customerReader->getIdByQuote($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetIdByQuoteWithoutCustomerReference(): void
    {
        $customerReference = null;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::never())
            ->method('getIdCustomerByCustomerReference');

        static::assertEquals(
            null,
            $this->customerReader->getIdByQuote($this->quoteTransferMock),
        );
    }
}
