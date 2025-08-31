<?php
namespace Core;

class Controller {
    protected function model($model) {
        $modelPath = "../app/Models/" . $model . ".php";
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $class = "App\\Models\\" . $model;
            return new $class;
        }
        throw new \Exception("Modelo $model no encontrado.");
    }
}
