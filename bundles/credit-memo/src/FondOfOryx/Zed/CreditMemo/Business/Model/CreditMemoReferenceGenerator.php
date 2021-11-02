<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use FondOfOryx\Shared\CreditMemo\CreditMemoConstants;
use FondOfOryx\Zed\CreditMemo\CreditMemoConfig;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToSequenceNumberFacadeInterface;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface;
use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;

class CreditMemoReferenceGenerator implements CreditMemoReferenceGeneratorInterface
{
    /**
     * @var string
     */
    protected const UNIQUE_IDENTIFIER_SEPARATOR = '-';

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToSequenceNumberFacadeInterface
     */
    protected $sequenceNumberFacade;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\CreditMemoConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToSequenceNumberFacadeInterface $sequenceNumberFacade
     * @param \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface $storeFacade
     * @param \FondOfOryx\Zed\CreditMemo\CreditMemoConfig $config
     */
    public function __construct(
        CreditMemoToSequenceNumberFacadeInterface $sequenceNumberFacade,
        CreditMemoToStoreFacadeInterface $storeFacade,
        CreditMemoConfig $config
    ) {
        $this->sequenceNumberFacade = $sequenceNumberFacade;
        $this->storeFacade = $storeFacade;
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function generate(): string
    {
        $sequenceNumberSettingsTransfer = $this->getSequenceNumberSettingsTransfer();

        return $this->sequenceNumberFacade->generate($sequenceNumberSettingsTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\SequenceNumberSettingsTransfer
     */
    protected function getSequenceNumberSettingsTransfer(): SequenceNumberSettingsTransfer
    {
        $sequenceNumberSettingsTransfer = (new SequenceNumberSettingsTransfer())
            ->setName(CreditMemoConstants::REFERENCE_NAME_VALUE)
            ->setPrefix($this->getSequenceNumberPrefix());

        if ($this->config->getReferenceOffset() === null) {
            return $sequenceNumberSettingsTransfer;
        }

        return $sequenceNumberSettingsTransfer->setOffset($this->config->getReferenceOffset());
    }

    /**
     * @return string
     */
    protected function getSequenceNumberPrefix(): string
    {
        $sequenceNumberPrefixParts = [
            $this->storeFacade->getCurrentStore()->getName(),
        ];

        $referencePrefix = $this->config->getReferencePrefix();

        if ($referencePrefix !== null && $referencePrefix !== '') {
            $sequenceNumberPrefixParts[0] = $referencePrefix;
        }

        $referenceEnvironmentPrefix = $this->config->getReferenceEnvironmentPrefix();

        if ($referenceEnvironmentPrefix !== null && $referenceEnvironmentPrefix !== '') {
            $sequenceNumberPrefixParts[] = $referenceEnvironmentPrefix;
        }

        return sprintf(
            '%s%s',
            implode($this->getUniqueIdentifierSeparator(), $sequenceNumberPrefixParts),
            $this->getUniqueIdentifierSeparator(),
        );
    }

    /**
     * Separator for the sequence number
     *
     * @return string
     */
    protected function getUniqueIdentifierSeparator(): string
    {
        return static::UNIQUE_IDENTIFIER_SEPARATOR;
    }
}
