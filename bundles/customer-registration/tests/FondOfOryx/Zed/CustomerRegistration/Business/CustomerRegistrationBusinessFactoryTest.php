<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\CustomerReferenceGenerator;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\EmailVerificationLinkGenerator;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGenerator;
use FondOfOryx\Zed\CustomerRegistration\Business\Processor\CustomerRegistrationProcessor;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\GdprStep;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\RegistrationStep;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\VerificationStep;
use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig;
use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationDependencyProvider;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Service\CustomerRegistrationToUtilTextServiceInterface;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManager;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepository;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationBusinessFactory
     */
    protected $customerRegistrationBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $sequenceNumberFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Service\CustomerRegistrationToUtilTextServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilTextServiceMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sequenceNumberFacadeMock = $this->getMockBuilder(CustomerRegistrationToSequenceNumberFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(CustomerRegistrationToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerFacadeMock = $this->getMockBuilder(CustomerRegistrationToCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(CustomerRegistrationToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilTextServiceMock = $this->getMockBuilder(CustomerRegistrationToUtilTextServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(CustomerRegistrationConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CustomerRegistrationEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CustomerRegistrationRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationBusinessFactory = new CustomerRegistrationBusinessFactory();
        $this->customerRegistrationBusinessFactory->setContainer($this->containerMock);
        $this->customerRegistrationBusinessFactory->setConfig($this->configMock);
        $this->customerRegistrationBusinessFactory->setEntityManager($this->entityManagerMock);
        $this->customerRegistrationBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerRegistrationProcessor(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CustomerRegistrationDependencyProvider::PLUGINS_CUSTOMER_REGISTRATION_PROCESSOR)
            ->willReturn([]);

        $this->assertInstanceOf(
            CustomerRegistrationProcessor::class,
            $this->customerRegistrationBusinessFactory->createCustomerRegistrationProcessor(),
        );
    }

    /**
     * @return void
     */
    public function testCreateRegistrationStep(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CustomerRegistrationDependencyProvider::SERVICE_UTIL_TEXT_SERVICE],
                [CustomerRegistrationDependencyProvider::FACADE_SEQUENCE_NUMBER],
                [CustomerRegistrationDependencyProvider::FACADE_STORE],
                [CustomerRegistrationDependencyProvider::FACADE_CUSTOMER],
                [CustomerRegistrationDependencyProvider::FACADE_LOCALE],
                [CustomerRegistrationDependencyProvider::PLUGINS_CUSTOMER_REGISTRATION_POST],
            )
            ->willReturnOnConsecutiveCalls(
                $this->utilTextServiceMock,
                $this->sequenceNumberFacadeMock,
                $this->storeFacadeMock,
                $this->customerFacadeMock,
                $this->localeFacadeMock,
                [],
            );

        $this->assertInstanceOf(
            RegistrationStep::class,
            $this->customerRegistrationBusinessFactory->createRegistrationStep(),
        );
    }

    /**
     * @return void
     */
    public function testCreateGdprStep(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CustomerRegistrationDependencyProvider::PLUGINS_GDPR_PRE],
                [CustomerRegistrationDependencyProvider::PLUGINS_GDPR_POST],
            )
            ->willReturnOnConsecutiveCalls(
                [],
                [],
            );

        $this->assertInstanceOf(
            GdprStep::class,
            $this->customerRegistrationBusinessFactory->createGdprStep(),
        );
    }

    /**
     * @return void
     */
    public function testCreateMailVerificationStep(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CustomerRegistrationDependencyProvider::PLUGINS_MAIL_VERIFICATION_PRE],
                [CustomerRegistrationDependencyProvider::PLUGINS_MAIL_VERIFICATION_POST],
            )
            ->willReturnOnConsecutiveCalls(
                [],
                [],
            );

        $this->assertInstanceOf(
            VerificationStep::class,
            $this->customerRegistrationBusinessFactory->createMailVerificationStep(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCustomerReferenceGenerator(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CustomerRegistrationDependencyProvider::FACADE_SEQUENCE_NUMBER],
                [CustomerRegistrationDependencyProvider::FACADE_STORE],
            )
            ->willReturnOnConsecutiveCalls(
                $this->sequenceNumberFacadeMock,
                $this->storeFacadeMock,
            );

        $this->assertInstanceOf(
            CustomerReferenceGenerator::class,
            $this->customerRegistrationBusinessFactory->createCustomerReferenceGenerator(),
        );
    }

    /**
     * @return void
     */
    public function testCreateEmailVerificationLinkGenerator(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CustomerRegistrationDependencyProvider::PLUGINS_EMAIL_VERIFICATION_LINK_EXTENDER],
            )
            ->willReturnOnConsecutiveCalls(
                [],
            );

        $this->assertInstanceOf(
            EmailVerificationLinkGenerator::class,
            $this->customerRegistrationBusinessFactory->createEmailVerificationLinkGenerator(),
        );
    }

    /**
     * @return void
     */
    public function testCreatePasswordGenerator(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CustomerRegistrationDependencyProvider::SERVICE_UTIL_TEXT_SERVICE)
            ->willReturn($this->utilTextServiceMock);

        $this->assertInstanceOf(
            PasswordGenerator::class,
            $this->customerRegistrationBusinessFactory->createPasswordGenerator(),
        );
    }
}
