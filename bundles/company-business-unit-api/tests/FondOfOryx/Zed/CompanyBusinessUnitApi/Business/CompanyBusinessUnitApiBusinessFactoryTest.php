<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Mapper;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiBusinessFactory;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApi;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator;
use FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig;
use FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiDependencyProvider;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepository;
use Spryker\Zed\Kernel\Container;

class CompanyBusinessUnitApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig
     */
    protected $companyBusinessUnitApiConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitApiConfigMock = $this->getMockBuilder(CompanyBusinessUnitApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyBusinessUnitApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this->getMockBuilder(CompanyBusinessUnitApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeMock = $this->getMockBuilder(CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyBusinessUnitApiBusinessFactory();

        $this->businessFactory->setConfig($this->companyBusinessUnitApiConfigMock);
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyBusinessUnitApi(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case CompanyBusinessUnitApiDependencyProvider::FACADE_API:
                        return $self->apiFacadeMock;
                    case CompanyBusinessUnitApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT:
                        return $self->companyBusinessUnitFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            CompanyBusinessUnitApi::class,
            $this->businessFactory->createCompanyBusinessUnitApi(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyBusinessUnitApiValidator(): void
    {
        static::assertInstanceOf(
            CompanyBusinessUnitApiValidator::class,
            $this->businessFactory->createCompanyBusinessUnitApiValidator(),
        );
    }
}
