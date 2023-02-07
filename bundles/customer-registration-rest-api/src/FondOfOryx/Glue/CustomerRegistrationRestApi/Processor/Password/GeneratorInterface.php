<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password;

interface GeneratorInterface
{
    /**
     * @param int $length
     * @param string|null $keySpace
     *
     * @return string
     */
    public function generate(int $length = 20, ?string $keySpace = null): string;
}
