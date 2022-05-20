<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ConcreteProductApi\Business\ConcreteProductApiFacade;
use FondOfOryx\Zed\ConcreteProductApi\ConcreteProductApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ConcreteProductApiResourcePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ConcreteProductApi\Communication\Plugin\Api\ConcreteProductApiResourcePlugin
     */
    protected $concreteProductApiResourcePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ConcreteProductApi\Business\ConcreteProductApiFacade
     */
    protected $concreteProductApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->concreteProductApiFacadeMock = $this->getMockBuilder(ConcreteProductApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->concreteProductApiResourcePlugin = new ConcreteProductApiResourcePlugin();
        $this->concreteProductApiResourcePlugin->setFacade($this->concreteProductApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(
            ConcreteProductApiConfig::RESOURCE_CONCRETE_PRODUCTS,
            $this->concreteProductApiResourcePlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $id = 1;

        $this->concreteProductApiFacadeMock->expects(static::atLeastOnce())
            ->method('getConcreteProduct')
            ->with($id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->concreteProductApiResourcePlugin->get($id),
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->concreteProductApiFacadeMock->expects(static::atLeastOnce())
            ->method('findConditionalProducts')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->concreteProductApiResourcePlugin->find(
                $this->apiRequestTransferMock,
            ),
        );
    }
}
