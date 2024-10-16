<?php

declare(strict_types=1);

namespace KaririCode\Exception\Contract;

use Throwable as GlobalThrowable;

interface Throwable extends GlobalThrowable
{
    public function getContext(): array;
}
