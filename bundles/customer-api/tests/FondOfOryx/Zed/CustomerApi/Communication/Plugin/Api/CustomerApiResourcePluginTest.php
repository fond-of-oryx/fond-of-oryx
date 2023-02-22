<?php


namespace FondOfOryx\Zed\CustomerApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerApi\Business\CustomerApiFacade;
use FondOfOryx\Zed\CustomerApi\CustomerApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CustomerApiResourcePluginTest extends Unit
{
    /**
     * @var (\Generated\Shared\Transfer\ApiDataTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiDataTransfer|MockObject $apiDataTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\ApiItemTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|ApiItemTransfer $apiItemTransferMock;

    /**
     * @var (\FondOfOryx\Zed\CustomerApi\Business\CustomerApiFacade&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerApiFacade|MockObject $customerApiFacadeMock;

    /**
     * @var (\Generated\Shared\Transfer\ApiRequestTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiRequestTransfer|MockObject $apiRequestTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\ApiCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiCollectionTransfer|MockObject $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Communication\Plugin\Api\CustomerApiResourcePlugin
     */
    protected CustomerApiResourcePlugin $customerApiResourcePlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerApiFacadeMock = $this->getMockBuilder(CustomerApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerApiResourcePlugin = new CustomerApiResourcePlugin();
        $this->customerApiResourcePlugin->setFacade($this->customerApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(
            CustomerApiConfig::RESOURCE_CUSTOMERS,
            $this->customerApiResourcePlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->customerApiFacadeMock->expects(static::atLeastOnce())
            ->method('addCustomer')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->customerApiResourcePlugin->add($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $id = 1;

        $this->customerApiFacadeMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->with($id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->customerApiResourcePlugin->get($id));
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $id = 1;

        $this->customerApiFacadeMock->expects(static::atLeastOnce())
            ->method('updateCustomer')
            ->with($id, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->customerApiResourcePlugin->update($id, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $id = 1;

        $this->customerApiFacadeMock->expects(static::atLeastOnce())
            ->method('removeCustomer')
            ->with($id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->customerApiResourcePlugin->remove($id));
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->customerApiFacadeMock->expects(static::atLeastOnce())
            ->method('findCustomers')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->customerApiResourcePlugin->find($this->apiRequestTransferMock),
        );
    }
}
