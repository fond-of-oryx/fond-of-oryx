<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanySearchRestApi\Business\Reader\CompanyReader;
use FondOfOryx\Zed\CompanySearchRestApi\CompanySearchRestApiDependencyProvider;
use FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepository;
use FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\SearchCompanyQueryExpanderPluginInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class CompanySearchRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepository&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanySearchRestApiRepository|MockObject $repositoryMock;

    /**
     * @var (\FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\SearchCompanyQueryExpanderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected SearchCompanyQueryExpanderPluginInterface|MockObject $searchCompanyQueryExpanderPluginMock;

    /**
     * @var \FondOfOryx\Zed\CompanySearchRestApi\Business\CompanySearchRestApiBusinessFactory
     */
    protected CompanySearchRestApiBusinessFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanySearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchCompanyQueryExpanderPluginMock = $this->getMockBuilder(SearchCompanyQueryExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanySearchRestApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanySearchRestApiDependencyProvider::PLUGINS_SEARCH_COMPANY_QUERY_EXPANDER)
            ->willReturn([$this->searchCompanyQueryExpanderPluginMock]);

        static::assertInstanceOf(
            CompanyReader::class,
            $this->factory->createCompanyReader(),
        );
    }
}
