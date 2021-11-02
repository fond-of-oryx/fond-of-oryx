<?php

namespace FondOfOryx\Yves\Feed\CSV;

interface CsvContentInterface
{
    /**
     * @param array<string> $headers
     *
     * @return void
     */
    public function setHeaders(array $headers): void;

    /**
     * @param array<string> $row
     *
     * @return void
     */
    public function addRow(array $row): void;

    /**
     * @return array<string>
     */
    public function getRows(): array;

    /**
     * @return string
     */
    public function getContent(): string;
}
