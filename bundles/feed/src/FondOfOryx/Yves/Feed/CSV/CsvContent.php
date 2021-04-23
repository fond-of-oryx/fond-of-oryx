<?php

namespace FondOfOryx\Yves\Feed\CSV;

class CsvContent implements CsvContentInterface
{
    /**
     * @var string[]
     */
    private $headers;

    /**
     * @var array
     */
    private $values = [];

    /**
     * @param string[] $headers
     */
    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @param string[] $headers
     *
     * @return void
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @param string[] $row
     *
     * @return void
     */
    public function addRow(array $row): void
    {
        $this->values[] = $row;
    }

    /**
     * @return string[]
     */
    public function getRows(): array
    {
        return $this->values;
    }

    /**
     * @param string[] $row
     *
     * @return string
     */
    protected function convertToString(array $row): string
    {
        return '"' . implode('";"', $this->escape($row)) . '"' . "\r\n";
    }

    /**
     * @param string[] $row
     *
     * @return string[]
     */
    protected function escape(array $row): array
    {
        return array_map(function ($value) {
            return str_replace('"', '\"', trim($value));
        }, $row);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        $content = $this->convertToString($this->headers);
        foreach ($this->values as $row) {
            $content .= $this->convertToString($row);
        }

        return $content;
    }
}
