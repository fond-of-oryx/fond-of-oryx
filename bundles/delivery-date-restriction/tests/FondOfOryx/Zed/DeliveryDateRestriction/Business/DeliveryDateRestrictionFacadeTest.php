<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidatorInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class DeliveryDateRestrictionFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\DeliveryDateRestriction\Business\DeliveryDateRestrictionBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Business\Expander\QuoteExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteExpanderMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidatorMock;

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Business\DeliveryDateRestrictionFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(DeliveryDateRestrictionBusinessFactory::class)
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

        $this->facade = new DeliveryDateRestrictionFacade();
        $this->facade->setFactory($this->businessFactoryMock);
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
}
