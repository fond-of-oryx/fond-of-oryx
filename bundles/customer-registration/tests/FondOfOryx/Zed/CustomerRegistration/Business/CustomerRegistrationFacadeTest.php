<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\EmailVerificationLinkGeneratorInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGeneratorInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\GdprStepInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\RegistrationStepInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\VerificationStepInterface;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManager;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerRegistrationFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationEntityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationBusinessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Steps\RegistrationStep|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $registrationStepMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Steps\VerificationStepInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $emailVerificationStepMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Steps\GdprStepInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $gdprStepMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Generator\EmailVerificationLinkGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $emailVerificationLinkGeneratorMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $passwordGeneratorMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface
     */
    protected $customerRegistrationFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerRegistrationBusinessFactoryMock = $this->getMockBuilder(CustomerRegistrationBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationEntityManagerMock = $this->getMockBuilder(CustomerRegistrationEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->registrationStepMock = $this->getMockBuilder(RegistrationStepInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->emailVerificationStepMock = $this->getMockBuilder(VerificationStepInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gdprStepMock = $this->getMockBuilder(GdprStepInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->emailVerificationLinkGeneratorMock = $this->getMockBuilder(EmailVerificationLinkGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->passwordGeneratorMock = $this->getMockBuilder(PasswordGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationEntityManagerMock = $this->getMockBuilder(CustomerRegistrationEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationFacade = new CustomerRegistrationFacade();
        $this->customerRegistrationFacade->setFactory($this->customerRegistrationBusinessFactoryMock);
        $this->customerRegistrationFacade->setEntityManager($this->customerRegistrationEntityManagerMock);
    }

    /**
     * @return void
     */
    public function testRegisterCustomer(): void
    {
        $this->customerRegistrationBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createRegistrationStep')
            ->willReturn($this->registrationStepMock);

        $this->registrationStepMock->expects($this->atLeastOnce())
            ->method('register')
            ->with($this->customerRegistrationRequestTransferMock)->willReturn($this->customerRegistrationRequestTransferMock);

        $this->customerRegistrationFacade->registerCustomer($this->customerRegistrationRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testVerifyMail(): void
    {
        $this->customerRegistrationBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createMailVerificationStep')
            ->willReturn($this->emailVerificationStepMock);

        $this->emailVerificationStepMock->expects($this->atLeastOnce())
            ->method('verifyEmail')
            ->with($this->customerRegistrationRequestTransferMock)->willReturn($this->customerRegistrationRequestTransferMock);

        $this->customerRegistrationFacade->verifyMail($this->customerRegistrationRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testCheckGdpr(): void
    {
        $this->customerRegistrationBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createGdprStep')
            ->willReturn($this->gdprStepMock);

        $this->gdprStepMock->expects($this->atLeastOnce())
            ->method('checkGdprState')
            ->with($this->customerRegistrationRequestTransferMock)->willReturn($this->customerRegistrationRequestTransferMock);

        $this->customerRegistrationFacade->checkGdpr($this->customerRegistrationRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testGenerateEmailVerificationLink(): void
    {
        $this->customerRegistrationBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createEmailVerificationLinkGenerator')
            ->willReturn($this->emailVerificationLinkGeneratorMock);

        $this->emailVerificationLinkGeneratorMock->expects($this->atLeastOnce())
            ->method('generateLink')
            ->with($this->customerTransferMock)->willReturn('test');

        $this->customerRegistrationFacade->generateEmailVerificationLink($this->customerTransferMock);
    }

    /**
     * @return void
     */
    public function testGenerateToken(): void
    {
        $this->customerRegistrationBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createPasswordGenerator')
            ->willReturn($this->passwordGeneratorMock);

        $this->passwordGeneratorMock->expects($this->atLeastOnce())
            ->method('generateRandomString')
            ->willReturn('test');

        $this->customerRegistrationFacade->generateToken();
    }

    /**
     * @return void
     */
    public function testFlagCustomerAsGdprAccepted(): void
    {
        $this->customerRegistrationEntityManagerMock->expects($this->atLeastOnce())
            ->method('flagCustomerAsGdprAccepted')
            ->willReturn($this->customerTransferMock);

        $this->customerRegistrationFacade->flagCustomerAsGdprAccepted($this->customerTransferMock);
    }

    /**
     * @return void
     */
    public function testSaveRegistrationKeyToCustomer(): void
    {
        $this->customerRegistrationEntityManagerMock->expects($this->atLeastOnce())
            ->method('persistRegistrationKeyToCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerRegistrationFacade->saveRegistrationKeyToCustomer($this->customerTransferMock);
    }
}
