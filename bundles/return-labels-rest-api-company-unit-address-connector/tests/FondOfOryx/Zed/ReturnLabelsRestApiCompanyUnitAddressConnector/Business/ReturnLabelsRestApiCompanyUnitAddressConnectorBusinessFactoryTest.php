<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Expander\ReturnLabelRequestExpander;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorRepository;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\ReturnLabelsRestApiCompanyUnitAddressConnectorConfig;

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
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\ReturnLabelsRestApiCompanyUnitAddressConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ReturnLabelsRestApiCompanyUnitAddressConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ReturnLabelsRestApiCompanyUnitAddressConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new ReturnLabelsRestApiCompanyUnitAddressConnectorBusinessFactory();
        $this->businessFactory->setRepository($this->repositoryMock);
        $this->businessFactory->setConfig($this->configMock);
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
