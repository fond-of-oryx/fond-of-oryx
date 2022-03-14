<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\LocaleExpander;
use FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\MailExpander;
use FondOfOryx\Zed\CompanyOmsMailConnector\CompanyOmsMailConnectorDependencyProvider;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToLocaleFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CompanyOmsMailConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToLocaleFacadeInterface
     */
    protected $localeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface
     */
    protected $companyUserReferenceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Business\CompanyOmsMailConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(CompanyOmsMailConnectorToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceFacadeMock = $this->getMockBuilder(CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyOmsMailConnectorBusinessFactory();

        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testLocaleExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyOmsMailConnectorDependencyProvider::FACADE_COMPANY_USER_REFERENCE],
                [CompanyOmsMailConnectorDependencyProvider::FACADE_LOCALE],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyOmsMailConnectorDependencyProvider::FACADE_COMPANY_USER_REFERENCE],
                [CompanyOmsMailConnectorDependencyProvider::FACADE_LOCALE],
            )
            ->willReturnOnConsecutiveCalls(
                $this->companyUserReferenceFacadeMock,
                $this->localeFacadeMock,
            );

        static::assertInstanceOf(
            LocaleExpander::class,
            $this->businessFactory->createLocaleExpander(),
        );
    }

    /**
     * @return void
     */
    public function testMailExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyOmsMailConnectorDependencyProvider::FACADE_COMPANY_USER_REFERENCE],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyOmsMailConnectorDependencyProvider::FACADE_COMPANY_USER_REFERENCE],
            )
            ->willReturnOnConsecutiveCalls(
                $this->companyUserReferenceFacadeMock,
            );

        static::assertInstanceOf(
            MailExpander::class,
            $this->businessFactory->createMailExpander(),
        );
    }
}
