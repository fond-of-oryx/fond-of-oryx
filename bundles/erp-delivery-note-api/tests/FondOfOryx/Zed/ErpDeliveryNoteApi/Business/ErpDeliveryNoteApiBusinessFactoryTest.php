<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Model\ErpDeliveryNoteApi;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Validator\ErpDeliveryNoteApiValidator;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToApiFacadeInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiDependencyProvider;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Persistence\ErpDeliveryNoteApiRepository;
use Spryker\Zed\Kernel\Container;

class ErpDeliveryNoteApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Persistence\ErpDeliveryNoteApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\ErpDeliveryNoteApiBusinessFactory
     */
    protected $erpDeliveryNoteApiBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteFacadeMock = $this->getMockBuilder(ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this->getMockBuilder(ErpDeliveryNoteApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ErpDeliveryNoteApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteApiBusinessFactory = new ErpDeliveryNoteApiBusinessFactory();
        $this->erpDeliveryNoteApiBusinessFactory->setContainer($this->containerMock);
        $this->erpDeliveryNoteApiBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateErpDeliveryNoteApi(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case ErpDeliveryNoteApiDependencyProvider::FACADE_API:
                        return $self->apiFacadeMock;
                    case ErpDeliveryNoteApiDependencyProvider::FACADE_ERP_DELIVERY_NOTE:
                        return $self->erpDeliveryNoteFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            ErpDeliveryNoteApi::class,
            $this->erpDeliveryNoteApiBusinessFactory->createErpDeliveryNoteApi(),
        );
    }

    /**
     * @return void
     */
    public function testCreateErpDeliveryNoteApiValidator(): void
    {
        static::assertInstanceOf(
            ErpDeliveryNoteApiValidator::class,
            $this->erpDeliveryNoteApiBusinessFactory->createErpDeliveryNoteApiValidator(),
        );
    }
}
