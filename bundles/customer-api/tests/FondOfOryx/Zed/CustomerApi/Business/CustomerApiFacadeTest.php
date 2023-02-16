<?php

namespace FondOfOryx\Zed\CustomerApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerApi\Business\Resource\CustomerResourceInterface;
use FondOfOryx\Zed\CustomerApi\Business\Validator\ApiRequestValidatorInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CustomerApiFacadeTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CustomerApi\Business\CustomerApiBusinessFactory&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerApiBusinessFactory $factoryMock;

    /**
     * @var (\FondOfOryx\Zed\CustomerApi\Business\Resource\CustomerResourceInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerResourceInterface $customerResourceMock;

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
     * @var (\FondOfOryx\Zed\CustomerApi\Business\Validator\ApiRequestValidatorInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|ApiRequestValidatorInterface $apiRequestValidatorMock;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Business\CustomerApiFacade
     */
    protected CustomerApiFacade $customerApiFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CustomerApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerResourceMock = $this->getMockBuilder(CustomerResourceInterface::class)
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

        $this->apiRequestValidatorMock = $this->getMockBuilder(ApiRequestValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerApiFacade = new CustomerApiFacade();
        $this->customerApiFacade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testAddCustomer(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCustomerResource')
            ->willReturn($this->customerResourceMock);

        $this->customerResourceMock->expects(static::atLeastOnce())
            ->method('add')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->customerApiFacade->addCustomer($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetCustomer(): void
    {
        $id = 1;

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCustomerResource')
            ->willReturn($this->customerResourceMock);

        $this->customerResourceMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->customerApiFacade->getCustomer($id),
        );
    }

    /**
     * @return void
     */
    public function testUpdateCustomer(): void
    {
        $id = 1;

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCustomerResource')
            ->willReturn($this->customerResourceMock);

        $this->customerResourceMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($id, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->customerApiFacade->updateCustomer($id, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testRemoveUpdate(): void
    {
        $id = 1;

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCustomerResource')
            ->willReturn($this->customerResourceMock);

        $this->customerResourceMock->expects(static::atLeastOnce())
            ->method('remove')
            ->with($id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->customerApiFacade->removeCustomer($id),
        );
    }

    /**
     * @return void
     */
    public function testFindCustomers(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCustomerResource')
            ->willReturn($this->customerResourceMock);

        $this->customerResourceMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->customerApiFacade->findCustomers($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testValidateApiRequest(): void
    {
        $errors = [];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createApiRequestValidator')
            ->willReturn($this->apiRequestValidatorMock);

        $this->apiRequestValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiRequestTransferMock)
            ->willReturn($errors);

        static::assertEquals($errors, $this->customerApiFacade->validateApiRequest($this->apiRequestTransferMock));
    }
}
