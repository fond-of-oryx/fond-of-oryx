<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Steps;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\CustomerReferenceGeneratorInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGeneratorInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface;
use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface;
use Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer;
use Generated\Shared\Transfer\CustomerRegistrationBagTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class RegistrationStepTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $postPluginMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $passwordGeneratorMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Generator\CustomerReferenceGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerReferenceGeneratorMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\PasswordHasher\PasswordHasherInterface
     */
    protected $passwordHasherMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationBagTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $bagTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $attributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Steps\RegistrationStepInterface
     */
    protected $step;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->postPluginMock = $this->getMockBuilder(CustomerRegistrationPostStepPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->passwordGeneratorMock = $this->getMockBuilder(PasswordGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerReferenceGeneratorMock = $this->getMockBuilder(CustomerReferenceGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerFacadeMock = $this->getMockBuilder(CustomerRegistrationToCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(CustomerRegistrationToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->passwordHasherMock = $this->getMockBuilder(PasswordHasherInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CustomerRegistrationEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bagTransferMock = $this->getMockBuilder(CustomerRegistrationBagTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->attributesTransferMock = $this->getMockBuilder(CustomerRegistrationAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->step = new RegistrationStep(
            $this->passwordGeneratorMock,
            $this->customerReferenceGeneratorMock,
            $this->customerFacadeMock,
            $this->localeFacadeMock,
            $this->passwordHasherMock,
            $this->entityManagerMock,
            [
                $this->postPluginMock,
                $this->postPluginMock,
            ],
        );
    }

    /**
     * @return void
     */
    public function testRegister(): void
    {
        $email = 'foo@bar.de';
        $this->requestTransferMock->expects(static::once())->method('getBag')->willReturn($this->bagTransferMock);
        $this->requestTransferMock->expects(static::once())->method('getAttributesOrFail')->willReturn($this->attributesTransferMock);
        $this->attributesTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn($email);
        $this->attributesTransferMock->expects(static::once())->method('getLanguage')->willReturn('de_DE');
        $this->customerFacadeMock->expects(static::once())->method('getCustomer')->willThrowException(new Exception());
        $this->bagTransferMock->expects(static::exactly(2))->method('setIsNewCustomer')->withConsecutive([false], [true])->willReturnSelf();
        $this->localeFacadeMock->expects(static::once())->method('getLocale')->willReturn($this->localeTransferMock);
        $this->passwordGeneratorMock->expects(static::once())->method('generate')->willReturn('password');
        $this->passwordGeneratorMock->expects(static::once())->method('generateRandomString')->willReturn('token');
        $this->passwordHasherMock->expects(static::once())->method('hash')->willReturn('encodedPassword');
        $this->customerReferenceGeneratorMock->expects(static::once())->method('generateCustomerReference')->willReturn('ref');
        $this->entityManagerMock->expects(static::once())->method('createCustomer')->willReturnCallback(static function (CustomerTransfer $customerTransfer) {
            static::assertSame('ref', $customerTransfer->getCustomerReference());
            static::assertSame('token', $customerTransfer->getRegistrationKey());
            static::assertSame('encodedPassword', $customerTransfer->getPassword());

            return $customerTransfer;
        });

        $this->postPluginMock->expects(static::exactly(2))->method('execute')->willReturn($this->requestTransferMock);
        $this->bagTransferMock->expects(static::once())->method('setCustomer')->willReturnSelf();
        $this->requestTransferMock->expects(static::once())->method('setBag')->willReturnSelf();
        $this->step->register($this->requestTransferMock);
    }

    /**
     * @return void
     */
    public function testRegisterSkipCreateNewCustomer(): void
    {
        $email = 'foo@bar.de';
        $this->requestTransferMock->expects(static::once())->method('getBag')->willReturn($this->bagTransferMock);
        $this->requestTransferMock->expects(static::once())->method('getAttributesOrFail')->willReturn($this->attributesTransferMock);
        $this->attributesTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn($email);
        $this->customerFacadeMock->expects(static::once())->method('getCustomer')->willReturn($this->customerTransferMock);
        $this->bagTransferMock->expects(static::once())->method('setIsNewCustomer')->withConsecutive([false])->willReturnSelf();
        $this->entityManagerMock->expects(static::never())->method('createCustomer');

        $this->postPluginMock->expects(static::exactly(2))->method('execute')->willReturn($this->requestTransferMock);
        $this->bagTransferMock->expects(static::once())->method('setCustomer')->willReturnSelf();
        $this->requestTransferMock->expects(static::once())->method('setBag')->willReturnSelf();
        $this->step->register($this->requestTransferMock);
    }

    /**
     * @return void
     */
    public function testRegisterWillBeSkipped(): void
    {
        $this->requestTransferMock->expects(static::once())->method('getBag')->willReturn($this->bagTransferMock);
        $this->requestTransferMock->expects(static::once())->method('setBag')->willReturnSelf();
        $this->requestTransferMock->expects(static::once())->method('getAttributesOrFail')->willReturn($this->attributesTransferMock);
        $this->attributesTransferMock->expects(static::atLeastOnce())->method('getEmail');

        $this->postPluginMock->expects(static::exactly(2))->method('execute')->willReturn($this->requestTransferMock);
        $this->step->register($this->requestTransferMock);
    }
}
