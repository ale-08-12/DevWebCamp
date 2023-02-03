<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;
use Model\EventosRegistros;
use Model\Regalo;

class RegistroController{
    public static function crear(Router $router){
        if(!is_auth()){
            header("Location: /login");
            return;
        }

        // Verificar si el usuario ya eligio un plan
        $registro = Registro::where("usuario_id", $_SESSION["id"]);

        if(isset($registro) && ($registro->paquete_id == "3" || $registro->paquete_id == "2")){
            header("Location: /boleto?token=" . urlencode($registro->token));
            return;
        }

        if(isset($registro) && $registro->paquete_id == "1"){
            header("Location: /finalizar-registro/conferencias");
            return;
        }

        $router->render("registro/crear", [
            "titulo" => "Finalizar Registro"
        ]);
    }

    public static function gratis(){
        if(!is_auth()){
            header("Location: /login");
            return;
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Verificar si el usuario ya eligio un plan
            $registro = Registro::where("usuario_id", $_SESSION["id"]);

            if(isset($registro) && $registro->paquete_id == "3"){
                header("Location: /boleto?token=" . urlencode($registro->token));
                return;
            }

            $token = substr(md5(uniqid(rand(), true)), 0, 8);
            
            // Crear Registro
            $datos = [
                "paquete_id" => 3,
                "pago_id" => "",
                "token" => $token,
                "usuario_id" => $_SESSION["id"]
            ];

            $registro = new Registro($datos);
            $resultado = $registro->guardar();

            if($resultado){
                header("Location: /boleto?token=" . urlencode($registro->token));
            }
        }
    }

    public static function pagar(){
        if(!is_auth()){
            header("Location: /login");
            return;
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Validar que POST no venga vacio
            if(empty($_POST)){
                echo json_encode([]);
                return;
            }

            // Crear Registro
            $datos = $_POST;
            $datos["token"] = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos["usuario_id"] = $_SESSION["id"];

            try {
                $registro = new Registro($datos);
                $resultado = $registro->guardar();
                echo json_encode($resultado);

            } catch (\Throwable $th) {
                echo json_encode([
                    "resultado" => "error"
                ]);
            }
        }
    }

    public static function conferencias(Router $router){
        if(!is_auth()){
            header("Location: /login");
            return;
        }

        // Validar que el usuario tenga el plan Presencial
        $usuario_id = $_SESSION["id"];
        $registro = Registro::where("usuario_id", $usuario_id);

        // Si no eligio ningun Pase
        if(!isset($registro)){
            header("Location: /");
            return;
        }

        // Si el Pase es Virtual o Gratis
        if($registro->paquete_id == "2" || $registro->paquete_id == "3"){
            header("Location: /boleto?token=" . urlencode($registro->token));
            return;
        }

        $regalo = Regalo::find($registro->regalo_id);
        
        // Si el Regalo es distinto "nada", es porque ya eligio las Conferencias y Regalo
        if(!str_contains(strtolower($regalo->nombre), "nada")){
            header("Location: /boleto?token=" . urlencode($registro->token));
            return;
        }

        // Empieza codigo para elegir Conferencias y Regalo
        $eventos = Evento::ordenar("hora_id", "ASC");
        $eventos_formateados = [];

        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            if($evento->dia_id === "1" && $evento->categoria_id === "1"){
                $eventos_formateados["conferencias_v"][] = $evento;
            }

            if($evento->dia_id === "2" && $evento->categoria_id === "1"){
                $eventos_formateados["conferencias_s"][] = $evento;
            }

            if($evento->dia_id === "1" && $evento->categoria_id === "2"){
                $eventos_formateados["workshops_v"][] = $evento;
            }

            if($evento->dia_id === "2" && $evento->categoria_id === "2"){
                $eventos_formateados["workshops_s"][] = $evento;
            }
        }

        $regalos = Regalo::all("ASC");

        // Manejando el registro mediante $_POST
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!is_auth()){
                header("Location: /login");
                return;
            }            
            
            // Extraemos los eventos y revisamos que no esten vacios
            $eventos = explode(",", $_POST["eventos"]);
            if(empty($eventos)){
                echo json_encode(["resultado" => false]);
                return;
            }

            //Obtener el registro del usuario y revisamos que el usuario este registrado
            $registro = Registro::where("usuario_id", $_SESSION["id"]);
            if(!isset($registro) || $registro->paquete_id != "1"){
                echo json_encode(["resultado" => false]);
                return;
            }

            // Array de eventos para almacenarlos en memoria y evitar otra consulta a la BD
            $eventos_array = [];

            // Validar la disponibilidad de los eventos seleccionados
            foreach($eventos as $evento_id){
                $evento = Evento::find($evento_id);

                // Comprobar que el evento exista
                if(!isset($evento) || $evento->disponibles == "0"){
                    echo json_encode(["resultado" => false]);
                    return;
                }

                $eventos_array[] = $evento;
            }

            foreach($eventos_array as $evento){
                $evento->disponibles -= 1;
                $evento->guardar();

                // Almacenar el Registro
                $datos = [
                    "evento_id" => (int) $evento->id,
                    "registro_id" => (int) $registro->id
                ];

                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->guardar();
            }

            // Almacenar el Regalo
            $registro->sincronizar(["regalo_id" => $_POST["regalo_id"]]);
            $resultado = $registro->guardar();
            
            if($resultado){
                echo json_encode([
                    "resultado" => $resultado,
                    "token" => $registro->token
                ]);
            } else {
                echo json_encode(["resultado" => false]);
            }
            
            return; // Evita que se haga un render a la vista y tire error en el js
        }

        $router->render("registro/conferencias", [
            "titulo" => "Elige Workshops y Conferencias",
            "eventos" => $eventos_formateados,
            "regalos" => $regalos
        ]);
    }

    public static function boleto(Router $router){
        if(!is_auth()){
            header("Location: /login");
            return;
        }

        // Validar la URL
        $token = $_GET["token"];

        if(!$token || strlen($token) != 8 ){
            header("Location: /");
            return;
        }

        // Buscar el token en la BD
        $registro = Registro::where("token", $token);

        if(!$registro){
            header("Location: /");
            return;
        }

        // Llenar las tablas de referencias
        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);

        $router->render("registro/boleto", [
            "titulo" => "Asistencia a DevWebCamp",
            "registro" => $registro
        ]);
    }
}