<?php
namespace BookWorms\Http;

use BookWorms\Validator;

class HttpRequest {
    public $method = null;
    public $uri = null;
    public $headers = null;
    public $cookies = null;
    private $data = null;
    private $session = null;
    private $errors = null;

    public function __construct() {
        $this->init_request_method();
        $this->init_request_uri();
        $this->init_request_headers();
        $this->init_request_cookies();
        $this->init_request_data();
        $this->init_session();
    }
    //-----------------------------------------------------------------------------------------------
    // private methods to initialise request
    //-----------------------------------------------------------------------------------------------
    private function init_request_uri() {
        if (isset($_SERVER) && is_array($_SERVER) && array_key_exists('REQUEST_URI', $_SERVER)) {
            $this->uri = $_SERVER['REQUEST_URI'];
        }
    }
    private function init_request_method() {
        if (isset($_SERVER) && is_array($_SERVER) && array_key_exists('REQUEST_METHOD', $_SERVER)) {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                case 'POST':
                    $this->method = $_SERVER['REQUEST_METHOD'];
                    break;
                default:
                    throw new InvalidArgumentException('Unexpected request method.');
                    break;
            }
        }
    }
    private function init_request_headers() {
        if (function_exists('getallheaders')) {
            $this->headers = getallheaders();
        }
    }
    private function init_request_cookies() {
        if (isset($_COOKIE) && is_array($_COOKIE)) {
            $this->cookies = $_COOKIE;
        }
    }
    private function init_request_data() {
        switch ($this->method) {
            case 'GET':
                $this->data = $_GET;
                break;
            case 'POST':
                $this->data = $_POST;
                break;
        }
    }
    private function init_session() {
        $this->session = new HttpSession();
     }
    //-----------------------------------------------------------------------------------------------
    // public methods
    //-----------------------------------------------------------------------------------------------
    public function validate($rules=[]) {
        $validator = new Validator();
        $this->errors = $validator->validate($rules, $this->data);
    }
    public function session() {
        return $this->session;
    }
    public function is_logged_in() {
        return $this->session()->has('email');
    }
    public function has_input($key) {
        return (isset($this->data) && is_array($this->data) && array_key_exists($key, $this->data));
    }
    public function input($key) {
        if (isset($this->data) && is_array($this->data) && array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        else {
            return null;
        }
    }
    public function all() {
        return $this->data;
    }
    public function is_valid() {
        return isset($this->errors) && is_array($this->errors) && empty($this->errors);
    }
    public function set_error($key, $value) {
        if (isset($this->errors) && is_array($this->errors)) {
          $this->errors[$key] = $value;
        }
      }
    public function has_error($key) {
        return (isset($this->errors) && is_array($this->errors) && array_key_exists($key, $this->errors));
    }
    public function error($key) {
        if (isset($this->errors) && is_array($this->errors) && array_key_exists($key, $this->errors)) {
            return $this->errors[$key];
        }
        else {
            return null;
        }
    }
    public function errors() {
        return $this->errors;
    }
    public function redirect($url) {
        header("Location: ".APP_URL.$url);
        exit();
    }
}
?>