<?php

declare(strict_types=1);

use Illuminate\Http\Client\Factory as HttpFactory;
use Mrfansi\Easypanel\Easypanel;
use Mrfansi\Easypanel\Http\HttpClient;

it('real: can fetch current user from live Easypanel', function () {
    if (! (bool) env('EASYPANEL_REAL_TEST', false)) {
        $this->markTestSkipped('EASYPANEL_REAL_TEST not enabled.');
    }

    $baseUrl = (string) env('EASYPANEL_BASE_URL', 'https://umwtg0.easypanel.host');
    $token = (string) env('EASYPANEL_AUTH_TOKEN');

    if ($baseUrl === '' || $token === '') {
        $this->markTestSkipped('EASYPANEL_BASE_URL or EASYPANEL_AUTH_TOKEN not set.');
    }

    $httpFactory = app(HttpFactory::class);
    $client = (new HttpClient($httpFactory))
        ->setBaseUrl($baseUrl)
        ->setAuthToken($token)
        ->setTimeout((int) env('EASYPANEL_TIMEOUT', 60));

    $easypanel = new Easypanel($client);

    $data = $easypanel->auth()->getUser();

    expect($data)->toBeArray();
    expect($data)->not->toBeEmpty();
})->group('real:easypanel');

it('real: can list projects from live Easypanel', function () {
    if (! (bool) env('EASYPANEL_REAL_TEST', false)) {
        $this->markTestSkipped('EASYPANEL_REAL_TEST not enabled.');
    }

    $baseUrl = (string) env('EASYPANEL_BASE_URL', 'https://umwtg0.easypanel.host');
    $token = (string) env('EASYPANEL_AUTH_TOKEN');

    if ($baseUrl === '' || $token === '') {
        $this->markTestSkipped('EASYPANEL_BASE_URL or EASYPANEL_AUTH_TOKEN not set.');
    }

    $httpFactory = app(HttpFactory::class);
    $client = (new HttpClient($httpFactory))
        ->setBaseUrl($baseUrl)
        ->setAuthToken($token)
        ->setTimeout((int) env('EASYPANEL_TIMEOUT', 60));

    $easypanel = new Easypanel($client);

    $data = $easypanel->projects()->listProjects();

    expect($data)->toBeArray();
})->group('real:easypanel');

it('real: can fetch system stats from live Easypanel', function () {
    if (! (bool) env('EASYPANEL_REAL_TEST', false)) {
        $this->markTestSkipped('EASYPANEL_REAL_TEST not enabled.');
    }

    $baseUrl = (string) env('EASYPANEL_BASE_URL', 'https://umwtg0.easypanel.host');
    $token = (string) env('EASYPANEL_AUTH_TOKEN');

    if ($baseUrl === '' || $token === '') {
        $this->markTestSkipped('EASYPANEL_BASE_URL or EASYPANEL_AUTH_TOKEN not set.');
    }

    $httpFactory = app(HttpFactory::class);
    $client = (new HttpClient($httpFactory))
        ->setBaseUrl($baseUrl)
        ->setAuthToken($token)
        ->setTimeout((int) env('EASYPANEL_TIMEOUT', 60));

    $easypanel = new Easypanel($client);

    $data = $easypanel->monitor()->getSystemStats();

    expect($data)->toBeArray();
})->group('real:easypanel');
