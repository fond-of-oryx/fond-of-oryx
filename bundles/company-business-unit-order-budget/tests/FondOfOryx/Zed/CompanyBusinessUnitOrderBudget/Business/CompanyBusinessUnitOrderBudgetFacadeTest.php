<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\CompanyBusinessUnitExpanderInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reducer\OrderBudgetReducerInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriterInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CompanyBusinessUnitOrderBudgetFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetBusinessFactory
     */
    protected $orderBudgetWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\QuoteExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteExpanderMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidatorMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reducer\OrderBudgetReducerInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $orderBudgetReducerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\CompanyBusinessUnitExpanderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitExpanderMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetWriterMock = $this->getMockBuilder(OrderBudgetWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpanderMock = $this->getMockBuilder(QuoteExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteValidatorMock = $this->getMockBuilder(QuoteValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetReducerMock = $this->getMockBuilder(OrderBudgetReducerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitExpanderMock = $this->getMockBuilder(CompanyBusinessUnitExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyBusinessUnitOrderBudgetFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testCreateOrderBudgetForCompanyBusinessUnit(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createOrderBudgetWriter')
            ->willReturn($this->orderBudgetWriterMock);

        $this->orderBudgetWriterMock->expects(static::atLeastOnce())
            ->method('createForCompanyBusinessUnit')
            ->with($this->companyBusinessUnitTransferMock);

        $this->facade->createOrderBudgetForCompanyBusinessUnit($this->companyBusinessUnitTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandQuote(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createQuoteExpander')
            ->willReturn($this->quoteExpanderMock);

        $this->quoteExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->expandQuote($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testValidateQuote(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createQuoteValidator')
            ->willReturn($this->quoteValidatorMock);

        $this->quoteValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->quoteTransferMock);

        $this->facade->validateQuote($this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testReduceOrderBudgetByQuote(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createOrderBudgetReducer')
            ->willReturn($this->orderBudgetReducerMock);

        $this->orderBudgetReducerMock->expects(static::atLeastOnce())
            ->method('reduceByQuote')
            ->with($this->quoteTransferMock);

        $this->facade->reduceOrderBudgetByQuote($this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandCompanyBusinessUnit(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyBusinessUnitExpander')
            ->willReturn($this->companyBusinessUnitExpanderMock);

        $this->companyBusinessUnitExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->companyBusinessUnitTransferMock)
            ->willReturn($this->companyBusinessUnitTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->facade->expandCompanyBusinessUnit($this->companyBusinessUnitTransferMock),
        );
    }
}
