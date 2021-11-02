<?php

namespace FondOfOryx\Service\CrossEngage\Model\Validator;

use Symfony\Component\Form\FormInterface;

interface FormValidatorCollectionInterface
{
    /**
     * @param \FondOfOryx\Service\CrossEngage\Model\Validator\FormValidatorInterface $formValidator
     *
     * @return $this|\FondOfOryx\Service\CrossEngage\Model\Validator\FormValidatorCollectionInterface
     */
    public function addValidator(FormValidatorInterface $formValidator): self;

    /**
     * @param string $validatorName
     *
     * @return array<\FondOfOryx\Service\CrossEngage\Model\Validator\FormValidatorInterface>
     */
    public function getValidator(string $validatorName): array;

    /**
     * @return array<\FondOfOryx\Service\CrossEngage\Model\Validator\FormValidatorInterface>
     */
    public function getValidators(): array;

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator();

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return bool
     */
    public function execValidation(FormInterface $form): bool;
}
