<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Generator;

use Exception;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Service\CustomerRegistrationToUtilTextServiceInterface;

class PasswordGenerator implements PasswordGeneratorInterface
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
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Service\CustomerRegistrationToUtilTextServiceInterface
     */
    protected $utilTextService;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Service\CustomerRegistrationToUtilTextServiceInterface $utilTextService
     */
    public function __construct(CustomerRegistrationToUtilTextServiceInterface $utilTextService)
    {
        $this->utilTextService = $utilTextService;
    }

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
            $parts[] = $keySpaceIndexed[mt_rand(0, $max)];
        }

        return implode('', $parts);
    }

    /**
     * @param int $length
     *
     * @return string
     */
    public function generateRandomString(int $length = 32): string
    {
        return $this->utilTextService->generateRandomString($length);
    }

    /**
     * @return string
     */
    protected function getKeySpace(): string
    {
        return sprintf('%s%s%s', static::CHARS, static::NUMBERS, static::SPECIAL_CHARS);
    }
}
