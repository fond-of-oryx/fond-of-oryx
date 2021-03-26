<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher\ErpOrderPageSearchPublisher;

class ErpOrderPageSearchFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher\ErpOrderPageSearchPublisher
     */
    protected $erpOrderPageSearchPublisherMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory
     */
    protected $erpOrderPageSearchBusinessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchFacadeInterface
     */
    protected $erpOrderPageSearchFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpOrderPageSearchBusinessFactoryMock = $this->getMockBuilder(ErpOrderPageSearchBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchPublisherMock = $this->getMockBuilder(ErpOrderPageSearchPublisher::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchFacade = new ErpOrderPageSearchFacade();
        $this->erpOrderPageSearchFacade->setFactory($this->erpOrderPageSearchBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testPublish()
    {
        $this->erpOrderPageSearchBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpOrderPageSearchPublisher')
            ->willReturn($this->erpOrderPageSearchPublisherMock);

        $this->erpOrderPageSearchPublisherMock->expects(static::atLeastOnce())
            ->method('publish');

        $this->erpOrderPageSearchFacade->publish([]);
    }
}
