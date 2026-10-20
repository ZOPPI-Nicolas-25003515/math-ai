<?php

namespace Core;
final class Request {
    private string $method;
    private string $path;
    private array $get;
    private array $post;
    private array $session;

    public function __construct(string $method, string $path,array $get, array $post, array $session) {
        $this->method = $method;
        $this->path = $path;
        $this->get = $get;
        $this->post = $post;
        $this->session = $session;
    }
    public static function fromGlobals(): self {
        return new Request($_SERVER['REQUEST_METHOD'],$_SERVER['REQUEST_URI'],$_GET,$_POST,$_SESSION);
    }

    public function post(string $key, string $default = null): mixed {
        return $this->post[$key] ?? $default;
    }

    public function get(string $key, string $default = null): mixed {
        return $this->get[$key] ?? $default;
    }

    public function session(string $key, string $default = null): mixed {
        return $this->session[$key] ?? $default;
    }

    public function setSession(string $key, string $value = null): void {
        $this->session[$key] = $value;
        $_SESSION[$key] = $value;
    }

}