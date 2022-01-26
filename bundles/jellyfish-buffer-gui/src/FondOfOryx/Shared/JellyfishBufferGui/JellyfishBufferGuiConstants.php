<?php

namespace FondOfOryx\Shared\JellyfishBufferGui;

interface JellyfishBufferGuiConstants
{
    /**
     * @var string
     */
    public const ANONYMIZATION_DATA = 'JELLYFISH_BUFFER_GUI:ANONYMIZATION_DATA';

    /**
     * @var array
     */
    public const ANONYMIZATION_DATA_DEFAULT = [
        'auth' => ['user', 'password'],
    ];
}
