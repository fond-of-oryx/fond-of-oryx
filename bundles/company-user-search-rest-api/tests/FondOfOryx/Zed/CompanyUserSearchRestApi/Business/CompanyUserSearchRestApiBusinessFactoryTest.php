<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Business\Reader\CompanyUserReader;
use FondOfOryx\Zed\CompanyUserSearchRestApi\CompanyUserSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepository;
use FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\SearchCompanyUserQueryExpanderPluginInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class CompanyUserSearchRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepository&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserSearchRestApiRepository|MockObject $repositoryMock;

    /**
     * @var (\FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\SearchCompanyUserQueryExpanderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected SearchCompanyUserQueryExpanderPluginInterface|MockObject $searchCompanyUserQueryExpanderPluginMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserSearchRestApi\Business\CompanyUserSearchRestApiBusinessFactory
     */
    protected CompanyUserSearchRestApiBusinessFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyUserSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchCompanyUserQueryExpanderPluginMock = $this->getMockBuilder(SearchCompanyUserQueryExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyUserSearchRestApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyUserSearchRestApiDependencyProvider::PLUGINS_SEARCH_COMPANY_USER_QUERY_EXPANDER)
            ->willReturn([$this->searchCompanyUserQueryExpanderPluginMock]);

        static::assertInstanceOf(
            CompanyUserReader::class,
            $this->factory->createCompanyUserReader(),
        );
    }
}
