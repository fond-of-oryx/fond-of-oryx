<?php

namespace FondOfOryx\Zed\CustomerApi\Business\Resource;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToApiFacadeInterface;
use FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerApi\Persistence\CustomerApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CustomerResourceTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToApiFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerApiToApiFacadeInterface $apiFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToCustomerFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerApiToCustomerFacadeInterface $customerFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\CustomerApi\Persistence\CustomerApiRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerApiRepositoryInterface|MockObject $repositoryMock;

    /**
     * @var (\Generated\Shared\Transfer\CustomerTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\CustomerResponseTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerResponseTransfer|MockObject $customerResponseTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\ApiDataTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiDataTransfer|MockObject $apiDataTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\ApiItemTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|ApiItemTransfer $apiItemTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\ApiRequestTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiRequestTransfer|MockObject $apiRequestTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\ApiCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiCollectionTransfer|MockObject $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Business\Resource\CustomerResource
     */
    protected CustomerResource $customerResource;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiFacadeMock = $this->getMockBuilder(CustomerApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerFacadeMock = $this->getMockBuilder(CustomerApiToCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CustomerApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerResponseTransferMock = $this->getMockBuilder(CustomerResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
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

        $this->customerResource = new CustomerResource(
            $this->apiFacadeMock,
            $this->customerFacadeMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $id = 1;

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('addCustomer')
            ->willReturn($this->customerResponseTransferMock);

        $this->customerResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerTransfer')
            ->willReturn($this->customerTransferMock);

        $this->customerResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($id);

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->customerTransferMock, $id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->customerResource->add($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testAddWithError(): void
    {
        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('addCustomer')
            ->willReturn($this->customerResponseTransferMock);

        $this->customerResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerTransfer')
            ->willReturn(null);

        $this->customerResponseTransferMock->expects(static::never())
            ->method('getIsSuccess');

        $this->customerTransferMock->expects(static::never())
            ->method('getIdCustomer');

        $this->apiFacadeMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->customerResource->add($this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $id = 1;
        $data = [];

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('findCustomerById')
            ->with(
                static::callback(
                    static fn (CustomerTransfer $customerTransfer): bool => $customerTransfer->getIdCustomer() === $id
                ),
            )
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($id);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with($data, true)
            ->willReturn($this->customerTransferMock);

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('updateCustomer')
            ->willReturn($this->customerResponseTransferMock);

        $this->customerResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerTransfer')
            ->willReturn($this->customerTransferMock);

        $this->customerResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($id);

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->customerTransferMock, (string)$id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->customerResource->update($id, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateWithError(): void
    {
        $data = [];
        $id = 1;

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('findCustomerById')
            ->with(
                static::callback(
                    static fn (CustomerTransfer $customerTransfer): bool => $customerTransfer->getIdCustomer() === $id
                ),
            )->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($id);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with($data, true)
            ->willReturn($this->customerTransferMock);

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('updateCustomer')
            ->willReturn($this->customerResponseTransferMock);

        $this->customerResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerTransfer')
            ->willReturn(null);

        $this->customerResponseTransferMock->expects(static::never())
            ->method('getIsSuccess');

        $this->apiFacadeMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->customerResource->update($id, $this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $id = 1;

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('deleteCustomer')
            ->with(
                static::callback(
                    static fn (CustomerTransfer $customerTransfer): bool => $customerTransfer->getIdCustomer() === $id
                ),
            )->willReturn(true);

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with(null, (string)$id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->customerResource->remove($id),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $id = 1;

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('findCustomerById')
            ->with(
                static::callback(
                    static fn (CustomerTransfer $customerTransfer): bool => $customerTransfer->getIdCustomer() === $id
                ),
            )->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($id);

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->customerTransferMock, $id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->customerResource->get($id),
        );
    }

    /**
     * @return void
     */
    public function testGetWithNotExistingCustomer(): void
    {
        $id = 2;

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('findCustomerById')
            ->with(
                static::callback(
                    static fn (CustomerTransfer $customerTransfer): bool => $customerTransfer->getIdCustomer() === $id
                ),
            )->willReturn(null);

        try {
            $this->customerResource->get($id);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $apiCollectionTransferData = [
            [
                'id_customer' => 1,
            ],
            [],
        ];

        $data = [
            'id_customer' => 1,
            'foo' => 'bar',
        ];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findCustomersByApiRequest')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($apiCollectionTransferData);

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('findCustomerById')
            ->with(
                static::callback(
                    static fn (
                        CustomerTransfer $customerTransfer
                    ): bool => $customerTransfer->getIdCustomer() === $apiCollectionTransferData[0]['id_customer']
                ),
            )->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($apiCollectionTransferData[0]['id_customer']);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setData')
            ->with(
                static::callback(
                    static fn (array $newData): bool => count($newData) === 1
                        && isset($newData[0]['id_customer'], $newData[0]['foo'])
                        && $newData[0]['id_customer'] === $data['id_customer']
                        && $newData[0]['foo'] === $data['foo']
                ),
            )->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->customerResource->find($this->apiRequestTransferMock),
        );
    }
}
