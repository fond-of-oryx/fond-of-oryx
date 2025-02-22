<?php


namespace FondOfOryx\Zed\CompanyApi\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyApi\Business\Model\CompanyApi;
use FondOfOryx\Zed\CompanyApi\Business\Model\Validator\CompanyApiValidator;
use FondOfOryx\Zed\CompanyApi\CompanyApiConfig;
use FondOfOryx\Zed\CompanyApi\CompanyApiDependencyProvider;
use FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToCompanyFacadeInterface;
use FondOfOryx\Zed\CompanyApi\Persistence\CompanyApiRepository;
use Spryker\Zed\Kernel\Container;

class CompanyApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyApi\CompanyApiConfig
     */
    protected $companyApiConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyApi\Persistence\CompanyApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyApi\Business\CompanyApiBusinessFactory
     */
    protected $companyApiBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyApiConfigMock = $this->getMockBuilder(CompanyApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyApiBusinessFactory = new CompanyApiBusinessFactory();

        $this->companyApiBusinessFactory->setConfig($this->companyApiConfigMock);
        $this->companyApiBusinessFactory->setContainer($this->containerMock);
        $this->companyApiBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyApi(): void
    {
        $apiFacadeMock = $this->getMockBuilder(CompanyApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apiToCompanyFacadeMock = $this->getMockBuilder(CompanyApiToCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($apiFacadeMock, $apiToCompanyFacadeMock) {
                switch ($key) {
                    case CompanyApiDependencyProvider::FACADE_API:
                        return $apiFacadeMock;
                    case CompanyApiDependencyProvider::FACADE_COMPANY:
                        return $apiToCompanyFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        $company = $this->companyApiBusinessFactory->createCompanyApi();

        static::assertInstanceOf(CompanyApi::class, $company);
    }

    /**
     * @return void
     */
    public function testCreateCompanyApiValidator(): void
    {
        $validator = $this->companyApiBusinessFactory->createCompanyApiValidator();

        static::assertInstanceOf(CompanyApiValidator::class, $validator);
    }
}
