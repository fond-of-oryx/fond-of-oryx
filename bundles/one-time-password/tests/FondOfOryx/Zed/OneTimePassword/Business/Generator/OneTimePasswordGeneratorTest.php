<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator;

class OneTimePasswordGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGenerator
     */
    protected $oneTimePasswordGenerator;

    /**
     * @var \Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $hybridPasswordGeneratorMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEntityManagerMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordConfigMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var string
     */
    protected $germanWordListPath;

    /**
     * @var int
     */
    protected $wordCount;

    /**
     * @var string
     */
    protected $wordSeparator;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var \Generated\Shared\Transfer\CustomerResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerResponseTransferMock;

    /**
     * @var bool
     */
    protected $success;

    /**
     * @var string
     */
    protected $autoLoginPath;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $autoLoginParameterName;

    /**
     * @var bool
     */
    protected $passwordGeneratorUppercase;

    /**
     * @var bool
     */
    protected $passwordGeneratorLowercase;

    /**
     * @var bool
     */
    protected $passwordGeneratorNumbers;

    /**
     * @var bool
     */
    protected $passwordGeneratorSymbols;

    /**
     * @var int
     */
    protected $passwordGeneratorSegmentLength;

    /**
     * @var int
     */
    protected $passwordGeneratorSegmentCount;

    /**
     * @var string
     */
    protected $passwordGeneratorSegmentSeparator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->hybridPasswordGeneratorMock = $this->getMockBuilder(HybridPasswordGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEntityManagerMock = $this->getMockBuilder(OneTimePasswordEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordConfigMock = $this->getMockBuilder(OneTimePasswordConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->germanWordListPath = 'german-word-list-path';

        $this->wordCount = 3;

        $this->wordSeparator = '-';

        $this->password = 'password';

        $this->customerResponseTransferMock = $this->getMockBuilder(CustomerResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->success = true;

        $this->autoLoginPath = 'auto-login-path';

        $this->email = 'email';

        $this->autoLoginParameterName = 'auto-login-parameter-name';

        $this->passwordGeneratorUppercase = true;

        $this->passwordGeneratorLowercase = true;

        $this->passwordGeneratorNumbers = true;

        $this->passwordGeneratorSymbols = true;

        $this->passwordGeneratorSegmentLength = 1;

        $this->passwordGeneratorSegmentCount = 2;

        $this->passwordGeneratorSegmentSeparator = 'segment-separator';

        $this->oneTimePasswordGenerator = new OneTimePasswordGenerator(
            $this->hybridPasswordGeneratorMock,
            $this->oneTimePasswordEntityManagerMock,
            $this->oneTimePasswordConfigMock
        );
    }

    /**
     * @return void
     */
    public function testGenerateOneTimePassword(): void
    {
        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('requireEmail');

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getPasswordGeneratorUppercase')
            ->willReturn($this->passwordGeneratorUppercase);

        $this->hybridPasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('setUppercase')
            ->with($this->passwordGeneratorUppercase)
            ->willReturnSelf();

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getPasswordGeneratorLowercase')
            ->willReturn($this->passwordGeneratorLowercase);

        $this->hybridPasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('setLowercase')
            ->with($this->passwordGeneratorLowercase)
            ->willReturnSelf();

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getPasswordGeneratorNumbers')
            ->willReturn($this->passwordGeneratorNumbers);

        $this->hybridPasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('setNumbers')
            ->with($this->passwordGeneratorNumbers)
            ->willReturnSelf();

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getPasswordGeneratorSymbols')
            ->willReturn($this->passwordGeneratorSymbols);

        $this->hybridPasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('setSymbols')
            ->with($this->passwordGeneratorSymbols)
            ->willReturnSelf();

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getPasswordGeneratorSegmentLength')
            ->willReturn($this->passwordGeneratorSegmentLength);

        $this->hybridPasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('setSegmentLength')
            ->with($this->passwordGeneratorSegmentLength)
            ->willReturnSelf();

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getPasswordGeneratorSegmentCount')
            ->willReturn($this->passwordGeneratorSegmentCount);

        $this->hybridPasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('setSegmentCount')
            ->with($this->passwordGeneratorSegmentCount)
            ->willReturnSelf();

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getPasswordGeneratorSegmentSeparator')
            ->willReturn($this->passwordGeneratorSegmentSeparator);

        $this->hybridPasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('setSegmentSeparator')
            ->with($this->passwordGeneratorSegmentSeparator)
            ->willReturnSelf();

        $this->hybridPasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('generatePassword')
            ->willReturn($this->password);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('setNewPassword')
            ->willReturnSelf();

        $this->oneTimePasswordEntityManagerMock->expects($this->atLeastOnce())
            ->method('updateCustomerPassword')
            ->willReturn($this->customerResponseTransferMock);

        $this->customerResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn($this->success);

        $this->customerResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerTransfer')
            ->willReturn($this->customerTransferMock);

        $this->assertInstanceOf(
            OneTimePasswordResponseTransfer::class,
            $this->oneTimePasswordGenerator->generateOneTimePassword(
                $this->customerTransferMock
            )
        );
    }
}
