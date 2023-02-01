<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderApi\Business\Model\ErpOrderApi;
use FondOfOryx\Zed\ErpOrderApi\Business\Validator\ErpOrderApiValidator;
use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToApiFacadeInterface;
use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface;
use FondOfOryx\Zed\ErpOrderApi\ErpOrderApiDependencyProvider;
use FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepository;
use Spryker\Zed\Kernel\Container;

class ErpOrderApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Business\ErpOrderApiBusinessFactory
     */
    protected $erpOrderApiBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderFacadeMock = $this->getMockBuilder(ErpOrderApiToErpOrderFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this->getMockBuilder(ErpOrderApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ErpOrderApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderApiBusinessFactory = new ErpOrderApiBusinessFactory();
        $this->erpOrderApiBusinessFactory->setContainer($this->containerMock);
        $this->erpOrderApiBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateErpOrderApi(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([ErpOrderApiDependencyProvider::FACADE_API], [ErpOrderApiDependencyProvider::FACADE_ERP_ORDER])
            ->willReturnOnConsecutiveCalls($this->apiFacadeMock, $this->erpOrderFacadeMock);

        static::assertInstanceOf(
            ErpOrderApi::class,
            $this->erpOrderApiBusinessFactory->createErpOrderApi(),
        );
    }

    /**
     * @return void
     */
    public function testCreateErpOrderApiValidator(): void
    {
        static::assertInstanceOf(
            ErpOrderApiValidator::class,
            $this->erpOrderApiBusinessFactory->createErpOrderApiValidator(),
        );
    }
}
