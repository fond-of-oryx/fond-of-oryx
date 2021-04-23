<?php

namespace FondOfOryx\Service\CrossEngage\Model\Validator;

use Symfony\Component\Form\FormInterface;

interface FormValidatorInterface
{
    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return bool
     */
    public function validate(FormInterface $form): bool;

    /**
     * @return string
     */
    public function getName(): string;
}
