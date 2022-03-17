<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\OmsOrderMailExpander;
use FondOfOryx\Zed\CountryOmsMailConnector\Persistence\CountryOmsMailConnectorRepository;

class CountryOmsMailConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Persistence\CountryOmsMailConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Business\CountryOmsMailConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CountryOmsMailConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CountryOmsMailConnectorBusinessFactory();
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateOmsOrderMailExpander(): void
    {
        static::assertInstanceOf(
            OmsOrderMailExpander::class,
            $this->factory->createOmsOrderMailExpander(),
        );
    }
}
