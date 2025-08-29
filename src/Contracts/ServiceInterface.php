<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Contracts;

interface ServiceInterface
{
    public function __construct(HttpClientInterface $httpClient);
}
