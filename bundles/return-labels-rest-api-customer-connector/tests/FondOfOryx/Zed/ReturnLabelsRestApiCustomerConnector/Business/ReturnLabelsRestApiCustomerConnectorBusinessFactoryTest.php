<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpander;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapper;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReader;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\ReturnLabelsRestApiCustomerConnectorRepository;

class ReturnLabelsRestApiCustomerConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\ReturnLabelsRestApiCustomerConnectorRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelsRestApiCustomerConnectorRepositoryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\ReturnLabelsRestApiCustomerConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->returnLabelsRestApiCustomerConnectorRepositoryMock = $this->getMockBuilder(ReturnLabelsRestApiCustomerConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ReturnLabelsRestApiCustomerConnectorBusinessFactory();
        $this->factory->setRepository($this->returnLabelsRestApiCustomerConnectorRepositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerExpander(): void
    {
        static::assertEquals(
            CustomerExpander::class,
            $this->factory->createCustomerExpander()
        );
    }
}
