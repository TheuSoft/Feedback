<?php
namespace generic;

class Acao {
    private $controller;
    private $metodo;

    public function __construct($controller, $metodo) {
        $this->controller = $controller;
        $this->metodo = $metodo;
    }

    public function executar() {
        $controllerName = "\\controller\\" . $this->controller;
        if (class_exists($controllerName)) {
            $obj = new $controllerName();
            if (method_exists($obj, $this->metodo)) {
                $obj->{$this->metodo}();
            } else {
                echo "Método {$this->metodo} não encontrado em {$this->controller}";
            }
        } else {
            echo "Controller {$this->controller} não encontrado!";
        }
    }
}