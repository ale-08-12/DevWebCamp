<?php

namespace Controllers;

use Model\Regalo;
use Model\Registro;

class APIRegalos {
    public static function index(){
        if(!is_admin()){
            header("Location: /login");
            return;
        }

        $regalos = Regalo::all();

        foreach ($regalos as $regalo){
            $regalo->total = Registro::totalArray(["regalo_id" => $regalo->id, "paquete_id" => "1"]);
        }

        // Quitamos el primero que es "nada" asi no se muestra en la grafica
        array_shift($regalos);

        echo json_encode($regalos);
        return;

    }
}