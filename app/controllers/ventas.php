<?php

// Carga inicial
class ventas extends controller{
    public function __construct(){
        $_SESSION['lista_venta'] = [];
        $this -> ventaModel = $this -> model('venta');
    }
    
    public function index(){
        $arreglo = $_SESSION['lista_venta'];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $escaner = $this -> ventaModel -> buscar($_POST['codigo']);
            $arreglo = array_push($escaner);
            $_SESSION['lista_venta'] = $arreglo;
        }

        $this -> view('ventas/index', $arreglo);
    }

    public function cobrar(){
        $_SESSION['lista_venta'] = [];
    }
}