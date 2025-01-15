<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\LocaleExpander;
use FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\MailExpander;
use FondOfOryx\Zed\CompanyOmsMailConnector\CompanyOmsMailConnectorDependencyProvider;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyFacadeInterface;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyFacadeInterface
     */
    protected $companyFacadeMock;

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

        $this->companyFacadeMock = $this->getMockBuilder(CompanyOmsMailConnectorToCompanyFacadeInterface::class)
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
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case CompanyOmsMailConnectorDependencyProvider::FACADE_COMPANY_USER_REFERENCE:
                        return $self->companyUserReferenceFacadeMock;
                    case CompanyOmsMailConnectorDependencyProvider::FACADE_LOCALE:
                        return $self->localeFacadeMock;
                    case CompanyOmsMailConnectorDependencyProvider::FACADE_COMPANY:
                        return $self->companyFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

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
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case CompanyOmsMailConnectorDependencyProvider::FACADE_COMPANY_USER_REFERENCE:
                        return $self->companyUserReferenceFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            MailExpander::class,
            $this->businessFactory->createMailExpander(),
        );
    }
}
