<?php

namespace FondOfOryx\Zed\CompanyUserApi\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyUserApi\Business\Model\CompanyUserApi;
use FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidator;
use FondOfOryx\Zed\CompanyUserApi\CompanyUserApiConfig;
use FondOfOryx\Zed\CompanyUserApi\CompanyUserApiDependencyProvider;
use FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\CompanyUserApi\Persistence\CompanyUserApiRepository;
use Spryker\Zed\Kernel\Container;

class CompanyUserApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserApi\Persistence\CompanyUserApiRepository
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserApi\CompanyUserApiConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserApi\Business\CompanyUserApiBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CompanyUserApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyUserApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this->getMockBuilder(CompanyUserApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserFacadeMock = $this->getMockBuilder(CompanyUserApiToCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyUserApiBusinessFactory();

        $this->factory->setConfig($this->configMock);
        $this->factory->setRepository($this->repositoryMock);
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyApi(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case CompanyUserApiDependencyProvider::FACADE_API:
                        return $self->apiFacadeMock;
                    case CompanyUserApiDependencyProvider::FACADE_COMPANY_USER:
                        return $self->companyUserFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            CompanyUserApi::class,
            $this->factory->createCompanyUserApi(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyApiValidator(): void
    {
        static::assertInstanceOf(
            CompanyUserApiValidator::class,
            $this->factory->createCompanyUserApiValidator(),
        );
    }
}
