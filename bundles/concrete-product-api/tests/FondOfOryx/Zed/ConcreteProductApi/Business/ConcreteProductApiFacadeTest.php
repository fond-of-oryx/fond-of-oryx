<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ConcreteProductApi\Business\Model\ConcreteProductApiInterface;
use FondOfOryx\Zed\ConcreteProductApi\Business\Validator\ConcreteProductApiValidatorInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ConcreteProductApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ConcreteProductApi\Business\ConcreteProductApiFacade
     */
    protected $concreteProductApiFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ConcreteProductApi\Business\ConcreteProductApiBusinessFactory
     */
    protected $concreteProductApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ConcreteProductApi\Business\Validator\ConcreteProductApiValidatorInterface
     */
    protected $concreteProductApiValidatorInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ConcreteProductApi\Business\Model\ConcreteProductApiInterface
     */
    protected $concreteProductApiInterfaceMock;

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
        $this->concreteProductApiBusinessFactoryMock = $this->getMockBuilder(ConcreteProductApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->concreteProductApiValidatorInterfaceMock = $this->getMockBuilder(ConcreteProductApiValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->concreteProductApiInterfaceMock = $this->getMockBuilder(ConcreteProductApiInterface::class)
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

        $this->concreteProductApiFacade = new ConcreteProductApiFacade();
        $this->concreteProductApiFacade->setFactory($this->concreteProductApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $errors = [];

        $this->concreteProductApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createConcreteProductApiValidator')
            ->willReturn($this->concreteProductApiValidatorInterfaceMock);

        $this->concreteProductApiValidatorInterfaceMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiRequestTransferMock)
            ->willReturn([]);

        static::assertEquals(
            $errors,
            $this->concreteProductApiFacade->validate($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetConcreteProduct(): void
    {
        $id = 1;

        $this->concreteProductApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createConcreteProductApi')
            ->willReturn($this->concreteProductApiInterfaceMock);

        $this->concreteProductApiInterfaceMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->concreteProductApiFacade->getConcreteProduct($id),
        );
    }

    /**
     * @return void
     */
    public function testFindConditionalProducts(): void
    {
        $this->concreteProductApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createConcreteProductApi')
            ->willReturn($this->concreteProductApiInterfaceMock);

        $this->concreteProductApiInterfaceMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->concreteProductApiFacade->findConcreteProducts($this->apiRequestTransferMock),
        );
    }
}
