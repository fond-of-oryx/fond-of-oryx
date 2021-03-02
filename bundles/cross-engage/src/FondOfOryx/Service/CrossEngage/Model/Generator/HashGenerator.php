<?php

namespace FondOfOryx\Service\CrossEngage\Model\Generator;

use FondOfOryx\Service\CrossEngage\CrossEngageConfig;
use FondOfOryx\Service\CrossEngage\Exception\ModifierNotFoundException;

class HashGenerator implements HashGeneratorInterface
{
    public const MODIFIER = [
        'lower' => 'strtolower',
        'upper' => 'strtoupper',
    ];

    /**
     * @var \FondOfOryx\Service\CrossEngage\CrossEngageConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Service\CrossEngage\CrossEngageConfig $config
     */
    public function __construct(CrossEngageConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function generate(string $string): string
    {
        if ($this->config->getModifyIn()) {
            $string = $this->modifyString($this->config->getModifierIn(), $string);
        }

        $string = call_user_func($this->getHashAlgo(), $string);

        if ($this->config->getModifyOut()) {
            $string = $this->modifyString($this->config->getModifierOut(), $string);
        }

        return $string;
    }

    /**
     * @param string $modifierType
     * @param string $string
     *
     * @return string
     */
    protected function modifyString(string $modifierType, string $string): string
    {
        $function = $this->getModifier($modifierType);

        return call_user_func($function, $string);
    }

    /**
     * @param string $modifier
     *
     * @throws \FondOfOryx\Service\CrossEngage\Exception\ModifierNotFoundException
     *
     * @return string
     */
    protected function getModifier(string $modifier): string
    {
        if (!array_key_exists($modifier, self::MODIFIER)) {
            throw new ModifierNotFoundException(
                sprintf(
                    'Modifier %s not found in available modifier list (%s)',
                    $modifier,
                    implode(', ', array_keys(self::MODIFIER))
                )
            );
        }

        return self::MODIFIER[$modifier];
    }

    /**
     * @return string
     */
    protected function getHashAlgo(): string
    {
        return $this->config->getHashAlgo();
    }
}
