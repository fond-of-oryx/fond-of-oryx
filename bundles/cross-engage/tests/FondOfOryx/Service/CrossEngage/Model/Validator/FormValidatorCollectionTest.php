<?php

namespace FondOfOryx\Service\CrossEngage\Model\Validator;

use Codeception\Test\Unit;
use Exception;
use Symfony\Component\Form\Form;

class FormValidatorCollectionTest extends Unit
{
    /**
     * @var \FondOfOryx\Service\CrossEngage\Model\Validator\FormValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $formValidatorMock;

    /**
     * @var \Symfony\Component\Form\FormInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $formMock;

    /**
     * @var \FondOfOryx\Service\CrossEngage\Model\Validator\FormValidatorCollectionInterface
     */
    protected $validator;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->formValidatorMock = $this->getMockBuilder(FormValidatorInterface::class)->disableOriginalConstructor()->getMock();
        $this->formMock = $this->getMockBuilder(Form::class)->disableOriginalConstructor()->getMock();

        $initValidator = clone $this->formValidatorMock;
        $initValidator->expects(static::exactly(2))->method('getName')->willReturn('init');

        $this->validator = new FormValidatorCollection([$initValidator]);
    }

    /**
     * @return void
     */
    public function testInit(): void
    {
        static::assertSame('init', $this->validator->getValidator('init')[0]->getName());
    }

    /**
     * @return void
     */
    public function testAddValidator(): void
    {
        $this->formValidatorMock->expects(static::once())->method('getName')->willReturn('test');

        static::assertSame($this->formValidatorMock, $this->validator->addValidator($this->formValidatorMock)->getValidator('test')[0]);
    }

    /**
     * @return void
     */
    public function testExecValidationTrue(): void
    {
        $this->formValidatorMock->expects(static::once())->method('getName')->willReturn('test');
        $this->formValidatorMock->expects(static::once())->method('validate')->willReturn(true);
        $validator = new FormValidatorCollection([$this->formValidatorMock]);

        static::assertTrue($validator->execValidation($this->formMock));
    }

    /**
     * @return void
     */
    public function testExecValidationFalse(): void
    {
        $this->formValidatorMock->expects(static::once())->method('getName')->willReturn('test');
        $this->formValidatorMock->expects(static::once())->method('validate')->willReturn(false);
        $validator = new FormValidatorCollection([$this->formValidatorMock]);

        static::assertFalse($validator->execValidation($this->formMock));
    }

    /**
     * @return void
     */
    public function testExecValidationException(): void
    {
        $this->formValidatorMock->expects(static::once())->method('getName')->willReturn('test');
        $this->formValidatorMock->expects(static::once())->method('validate')->willThrowException(new Exception('test'));
        $validator = new FormValidatorCollection([$this->formValidatorMock]);

        static::assertFalse($validator->execValidation($this->formMock));
    }
}
