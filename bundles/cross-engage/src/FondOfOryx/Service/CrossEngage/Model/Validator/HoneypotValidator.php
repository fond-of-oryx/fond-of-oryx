<?php

namespace FondOfOryx\Service\CrossEngage\Model\Validator;

use FondOfOryx\Service\CrossEngage\Exception\FormValidatorValidationErrorException;
use Symfony\Component\Form\FormInterface;

class HoneypotValidator implements FormValidatorInterface
{
    /**
     * @var string
     */
    public const NAME = 'HoneypotValidator';

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @throws \FondOfOryx\Service\CrossEngage\Exception\FormValidatorValidationErrorException
     *
     * @return bool
     */
    public function validate(FormInterface $form): bool
    {
        if ($form->get('name')->getData() !== null) {
            throw new FormValidatorValidationErrorException(sprintf('%s failt to validate!', $this->getName()));
        }

        return true;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }
}
