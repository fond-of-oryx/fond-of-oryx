<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator;

class OneTimePasswordGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGenerator
     */
    protected $oneTimePasswordGenerator;

    /**
     * @var \Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $humanPasswordGeneratorMock;

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
     * @return void
     */
    protected function _before(): void
    {
        $this->humanPasswordGeneratorMock = $this->getMockBuilder(HumanPasswordGenerator::class)
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

        $this->oneTimePasswordGenerator = new OneTimePasswordGenerator(
            $this->humanPasswordGeneratorMock,
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
            ->method('getGermanWordListPath')
            ->willReturn($this->germanWordListPath);

        $this->humanPasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('setWordList')
            ->willReturnSelf();

        $this->humanPasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('setWordCount')
            ->with($this->wordCount)
            ->willReturnSelf();

        $this->humanPasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('setWordSeparator')
            ->with($this->wordSeparator)
            ->willReturnSelf();

        $this->humanPasswordGeneratorMock->expects($this->atLeastOnce())
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
