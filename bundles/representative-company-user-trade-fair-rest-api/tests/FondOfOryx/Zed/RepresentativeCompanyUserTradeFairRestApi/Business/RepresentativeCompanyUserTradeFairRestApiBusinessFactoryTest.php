<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\TradeFairRepresentationManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepository;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiDependencyProvider;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class RepresentativeCompanyUserTradeFairRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected MockObject|Container $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiConfig $configMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\RepresentativeCompanyUserTradeFairRestApiBusinessFactory
     */
    protected RepresentativeCompanyUserTradeFairRestApiBusinessFactory $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepository
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiRepository $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface $representativeCompanyUserTradeFairRestApiToCompanyTypeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\TradeFairRepresentationManagerInterface
     */
    protected MockObject|TradeFairRepresentationManagerInterface $tradeFairRepresentationManagerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this
            ->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairRestApiToCompanyTypeFacadeMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new RepresentativeCompanyUserTradeFairRestApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setConfig($this->configMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateTradeFairRepresentationManager(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [RepresentativeCompanyUserTradeFairRestApiDependencyProvider::FACADE_REPRESENTATIVE_COMPANY_USER],
                [RepresentativeCompanyUserTradeFairRestApiDependencyProvider::FACADE_COMPANY_TYPE],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [RepresentativeCompanyUserTradeFairRestApiDependencyProvider::FACADE_REPRESENTATIVE_COMPANY_USER],
                [RepresentativeCompanyUserTradeFairRestApiDependencyProvider::FACADE_COMPANY_TYPE],
            )->willReturnOnConsecutiveCalls(
                $this->representativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeMock,
                $this->representativeCompanyUserTradeFairRestApiToCompanyTypeFacadeMock,
            );

        static::assertInstanceOf(
            TradeFairRepresentationManagerInterface::class,
            $this->factory->createTradeFairRepresentationManager(),
        );
    }

    /**
     * @return void
     */
    public function testCreateDurationValidator(): void
    {
        static::assertInstanceOf(
            DurationValidatorInterface::class,
            $this->factory->createDurationValidator(),
        );
    }
}
