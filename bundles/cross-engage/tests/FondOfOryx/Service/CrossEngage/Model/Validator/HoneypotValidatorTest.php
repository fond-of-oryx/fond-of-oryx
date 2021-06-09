<?php

namespace FondOfOryx\Service\CrossEngage\Model\Validator;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Service\CrossEngage\Exception\FormValidatorValidationErrorException;
use Symfony\Component\Form\Form;

class HoneypotValidatorTest extends Unit
{
    /**
     * @var \Symfony\Component\Form\FormInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $formMock;

    /**
     * @var \FondOfOryx\Service\CrossEngage\Model\Validator\FormValidatorInterface
     */
    protected $validator;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->formMock = $this->getMockBuilder(Form::class)->disableOriginalConstructor()->getMock();

        $this->validator = new HoneypotValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->formMock->expects(static::once())->method('get')->willReturn($this->formMock);
        $this->formMock->expects(static::once())->method('getData')->willReturn(null);

        static::assertTrue($this->validator->validate($this->formMock));
    }

    /**
     * @return void
     */
    public function testValidateTrap(): void
    {
        $this->formMock->expects(static::once())->method('get')->willReturn($this->formMock);
        $this->formMock->expects(static::once())->method('getData')->willReturn('trapped');

        $catch = '';
        try {
            $this->validator->validate($this->formMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }
        static::assertNotEmpty($catch);
        static::assertInstanceOf(FormValidatorValidationErrorException::class, $catch);
    }
}
