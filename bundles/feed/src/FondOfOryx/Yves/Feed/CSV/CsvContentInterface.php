<?php

namespace FondOfOryx\Yves\Feed\CSV;

interface CsvContentInterface
{
    /**
     * @param string[] $headers
     *
     * @return void
     */
    public function setHeaders(array $headers): void;

    /**
     * @param string[] $row
     *
     * @return void
     */
    public function addRow(array $row): void;

    /**
     * @return string[]
     */
    public function getRows(): array;

    /**
     * @return string
     */
    public function getContent(): string;
}
