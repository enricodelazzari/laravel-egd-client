<?php

namespace EnricoDeLazzari\EgdClient\Http;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http as LaravelHttp;
use Illuminate\Support\Stringable;

class Http
{
    protected function baseUrl(): string
    {
        return config('egd-client.base_url');
    }

    protected function send(array $options = []): Response
    {
        return LaravelHttp::send(
            $this->getMethod(),
            $this->endpoint(),
            $options
        );
    }

    protected function route(): string
    {
        return '';
    }

    protected function getMethod(): string
    {
        return defined('static::METHOD') ? static::METHOD : 'post';
    }

    protected function endpoint(): string
    {
        return $this->getBaseUrl()
            ->finish('/')
            ->append($this->getRoute())
            ->toString();
    }

    protected function getBaseUrl(): Stringable
    {
        return str($this->baseUrl())
            ->rtrim('/');
    }

    protected function getRoute(): Stringable
    {
        return str($this->route())
            ->ltrim('/');
    }
}
