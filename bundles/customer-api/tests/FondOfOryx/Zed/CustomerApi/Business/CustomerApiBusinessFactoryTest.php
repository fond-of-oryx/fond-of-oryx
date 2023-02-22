<?php

namespace FondOfOryx\Zed\CustomerApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerApi\Business\Resource\CustomerResource;
use FondOfOryx\Zed\CustomerApi\Business\Validator\ApiRequestValidator;
use FondOfOryx\Zed\CustomerApi\CustomerApiDependencyProvider;
use FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToApiFacadeInterface;
use FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerApi\Persistence\CustomerApiRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class CustomerApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Zed\CustomerApi\Persistence\CustomerApiRepository&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerApiRepository $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Business\CustomerApiBusinessFactory
     */
    protected CustomerApiBusinessFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CustomerApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CustomerApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerResource(): void
    {
        $apiFacadeMock = $this->getMockBuilder(CustomerApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apiToCustomerFacadeMock = $this->getMockBuilder(CustomerApiToCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CustomerApiDependencyProvider::FACADE_API],
                [CustomerApiDependencyProvider::FACADE_CUSTOMER],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CustomerApiDependencyProvider::FACADE_API],
                [CustomerApiDependencyProvider::FACADE_CUSTOMER],
            )
            ->willReturnOnConsecutiveCalls(
                $apiFacadeMock,
                $apiToCustomerFacadeMock,
            );

        static::assertInstanceOf(
            CustomerResource::class,
            $this->factory->createCustomerResource(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCustomerApiValidator(): void
    {
        static::assertInstanceOf(
            ApiRequestValidator::class,
            $this->factory->createApiRequestValidator(),
        );
    }
}
