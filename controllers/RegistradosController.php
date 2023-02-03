<?php

namespace Controllers;

use MVC\Router;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;
use Classes\Paginacion;

class RegistradosController{
    public static function index(Router $router){
        if(!is_admin()){
            header("Location: /login");
            return;
        }

        $pagina_actual = filter_var($_GET["page"], FILTER_VALIDATE_INT);

        $registros_por_pagina = filter_var($_GET["epp"], FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1 || !$registros_por_pagina || $registros_por_pagina < 1){
            header("Location: /admin/registrados?page=1&epp=10");
        }
        
        $total_registros = Registro::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

        if($pagina_actual > $paginacion->total_paginas() && $paginacion->total_paginas() != 0){
            header("Location: /admin/registrados?page=1&epp=10");
        }

        $registros = Registro::paginar($paginacion->registros_por_pagina, $paginacion->offset());

        foreach($registros as $registro){
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
        }

        $router->render("admin/registrados/index", [
            "titulo" => "Usuarios Registrados",
            "registros" => $registros,
            "paginacion" => $paginacion->paginacion()
        ]);
    }
}