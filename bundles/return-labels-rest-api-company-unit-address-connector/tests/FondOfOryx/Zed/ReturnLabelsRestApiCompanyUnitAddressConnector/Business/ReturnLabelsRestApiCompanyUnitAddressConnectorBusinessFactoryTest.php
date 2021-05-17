<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Expander\ReturnLabelRequestExpander;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorRepository;

class ReturnLabelsRestApiCompanyUnitAddressConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\ReturnLabelsRestApiCompanyUnitAddressConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ReturnLabelsRestApiCompanyUnitAddressConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new ReturnLabelsRestApiCompanyUnitAddressConnectorBusinessFactory();
        $this->businessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateReturnLabelRequestExpander(): void
    {
        static::assertInstanceOf(
            ReturnLabelRequestExpander::class,
            $this->businessFactory->createReturnLabelRequestExpander()
        );
    }
}
