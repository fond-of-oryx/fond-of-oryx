<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Persistence\SplittableCheckoutRestApiCustomerConnectorRepository;

class SplittableCheckoutRestApiCustomerConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Persistence\SplittableCheckoutRestApiCustomerConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business\SplittableCheckoutRestApiCustomerConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(SplittableCheckoutRestApiCustomerConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new SplittableCheckoutRestApiCustomerConnectorBusinessFactory();
        $this->businessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteExpander(): void
    {
        static::assertInstanceOf(
            QuoteExpander::class,
            $this->businessFactory->createQuoteExpander(),
        );
    }
}
