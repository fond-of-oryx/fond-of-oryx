<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Expander\ReturnLabelRequestExpanderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\ReturnLabelsRestApiCompanyConnectorRepository;

class ReturnLabelsRestApiCompanyConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\ReturnLabelsRestApiCompanyConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelsRestApiCompanyConnectorRepositoryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\ReturnLabelsRestApiCompanyConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->returnLabelsRestApiCompanyConnectorRepositoryMock = $this
            ->getMockBuilder(ReturnLabelsRestApiCompanyConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ReturnLabelsRestApiCompanyConnectorBusinessFactory();
        $this->factory->setRepository($this->returnLabelsRestApiCompanyConnectorRepositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateReturnLabelRequestExpander(): void
    {
        static::assertInstanceOf(
            ReturnLabelRequestExpanderInterface::class,
            $this->factory->createReturnLabelRequestExpander(),
        );
    }
}
