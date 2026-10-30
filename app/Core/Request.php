<?php

namespace App\Core;
final class Request {
    public string $method;
    public string $path;
    public array $get;
    public array $post;
    public array $session;

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

    public function post(string $key, $default = null): mixed {
        return $this->post[$key] ?? $default;
    }

    public function get(string $key, $default = null): mixed {
        return $this->get[$key] ?? $default;
    }

    public function session(string $key, $default = null): mixed {
        return $this->session[$key] ?? $default;
    }

    public function setSession(string $key, $values = null): void {
        $this->session[$key] = $values;
        $_SESSION[$key] = $values;
    }

}