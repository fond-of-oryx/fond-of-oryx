<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password;

use Exception;

class Generator implements GeneratorInterface
{
    /**
     * @var string
     */
    protected const CHARS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * @var string
     */
    protected const SPECIAL_CHARS = '!@#$%^&*()_+-=?';

    /**
     * @var string
     */
    protected const NUMBERS = '0123456789';

    /**
     * @param int $length
     * @param string|null $keySpace
     *
     * @throws \Exception
     *
     * @return string
     */
    public function generate(int $length = 20, ?string $keySpace = null): string
    {
        if ($length <= 0) {
            throw new Exception('Password length must be at least 1 length!');
        }

        if ($keySpace === null) {
            $keySpace = $this->getKeySpace();
        }

        $keySpaceIndexed = str_split(str_shuffle($keySpace));
        $parts = [];
        $max = count($keySpaceIndexed) - 1;

        for ($i = 1; $i <= $length; ++$i) {
            $parts[] = $keySpaceIndexed[random_int(0, $max)];
        }

        return implode('', $parts);
    }

    /**
     * @return string
     */
    protected function getKeySpace(): string
    {
        return sprintf('%s%s%s', static::CHARS, static::NUMBERS, static::SPECIAL_CHARS);
    }
}
