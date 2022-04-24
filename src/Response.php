<?php

declare(strict_types=1);

namespace Kmvan\Response;

class Response
{
    private ?array $data = null;

    private array $headers = [
        'Content-Type: application/json; charset=utf-8',
    ];

    private int $status = 0;

    public function setHeader(
        string $key,
        string $value,
        bool $replace = true
    ): self {
        if ($replace || ! isset($this->headers[$key])) {
            $this->headers[$key] = $value;
        } else {
            $this->headers[$key] .= ", {$value}";
        }

        return $this;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setData(?array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function toJson(): string
    {
        $data = $this->getData();

        if (null === $data) {
            return '';
        }

        return json_encode($data, \JSON_UNESCAPED_UNICODE);
    }

    public function end(): void
    {
        if ($this->status) {
            http_response_code($this->status);
        }

        foreach ($this->headers as $header) {
            header($header);
        }

        $json = $this->toJson();

        if ('' === $json) {
            exit;
        }

        exit($json);
    }
}
