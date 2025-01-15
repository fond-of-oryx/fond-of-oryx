<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApi;
use FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidator;
use FondOfOryx\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiDependencyProvider;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiRepository;
use Spryker\Zed\Kernel\Container;

class CompanyUnitAddressApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToApiFacadeInterface
     */
    protected $apiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiRepository
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this->getMockBuilder(CompanyUnitAddressApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyUnitAddressApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyUnitAddressApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressApi(): void
    {
        $self = $this;

        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case CompanyUnitAddressApiDependencyProvider::FACADE_API:
                        return $self->apiFacadeMock;
                    case CompanyUnitAddressApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS:
                        return $self->companyUnitAddressFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            CompanyUnitAddressApi::class,
            $this->factory->createCompanyUnitAddressApi(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressApiValidator(): void
    {
        static::assertInstanceOf(
            CompanyUnitAddressApiValidator::class,
            $this->factory->createCompanyUnitAddressApiValidator(),
        );
    }
}
