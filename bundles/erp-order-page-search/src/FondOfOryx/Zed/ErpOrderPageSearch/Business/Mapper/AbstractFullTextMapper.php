<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

abstract class AbstractFullTextMapper implements FullTextMapperInterface
{
    /**
     * @param array $data
     *
     * @return array<string>
     */
    public function fromData(array $data): array
    {
        $fullText = [];

        foreach ($this->getFields() as $field) {
            $value = $this->filterItemByField($data, $field);

            if (!$this->isPossibleItem($value)) {
                continue;
            }

            $fullText[] = $value;
        }

        return $fullText;
    }

    /**
     * @return array<string>
     */
    abstract protected function getFields(): array;

    /**
     * @param array $data
     * @param string $field
     *
     * @return mixed
     */
    protected function filterItemByField(array $data, string $field): mixed
    {
        $value = $data;

        foreach (explode('.', $field) as $key) {
            if (!isset($value[$key])) {
                return null;
            }

            $value = $value[$key];
        }

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    protected function isPossibleItem(mixed $value): bool
    {
        return is_scalar($value) && !is_bool($value) && (string)$value !== '';
    }
}
