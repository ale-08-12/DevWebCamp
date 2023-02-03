<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController{
    public static function index(Router $router){
        if(!is_admin()){
            header("Location: /login");
            return;
        }

        $pagina_actual = filter_var($_GET["page"], FILTER_VALIDATE_INT);

        $registros_por_pagina = filter_var($_GET["epp"], FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1 || !$registros_por_pagina || $registros_por_pagina < 1){
            header("Location: /admin/ponentes?page=1&epp=10");
        }
        
        $total_registros = Ponente::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

        if($pagina_actual > $paginacion->total_paginas() && $paginacion->total_paginas() != 0){
            header("Location: /admin/ponentes?page=1&epp=10");
        }

        $ponentes = Ponente::paginar($paginacion->registros_por_pagina, $paginacion->offset());

        $router->render("admin/ponentes/index", [
            "titulo" => "Ponentes / Conferencistas",
            "ponentes" => $ponentes,
            "paginacion" => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router){
        if(!is_admin()){
            header("Location: /login");
            return;
        }

        $alertas = [];

        $ponente = new Ponente;
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Leer Imagen
            if(!empty($_FILES["imagen"]["tmp_name"])){
                $carpeta_imagenes = "../public/img/speakers";

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("png", 80);
                $imagen_webp = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("webp", 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST["imagen"] = $nombre_imagen;
            }

            $_POST["redes"] = json_encode($_POST["redes"], JSON_UNESCAPED_SLASHES);
            
            $ponente->sincronizar($_POST);

            // Validar
            $alertas = $ponente->validar();

            // Guardar el resgistro
            if(empty($alertas)){
                // Guardar las imagenes
                $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");

                // Guardar en la BD
                $resultado = $ponente->guardar();

                if($resultado){
                    header("Location: /admin/ponentes");
                }
            }
        }

        $router->render("/admin/ponentes/crear", [
            "titulo" => "Registrar Ponente",
            "alertas" => $alertas,
            "ponente" => $ponente,
            "redes" => json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router){
        if(!is_admin()){
            header("Location: /login");
            return;
        }

        $alertas = [];
        $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

        if(!$id){
            header("Location: /admin/ponentes");
        }

        // Obtener el ponente a editar
        $ponente = Ponente::find($id);

        if(!$ponente){
            header("Location: /admin/ponentes");
        }

        $ponente->imagen_actual = $ponente->imagen;

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Leer Imagen
            if(!empty($_FILES["imagen"]["tmp_name"])){
                $carpeta_imagenes = "../public/img/speakers";

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("png", 80);
                $imagen_webp = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("webp", 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST["imagen"] = $nombre_imagen;

                unlink($carpeta_imagenes . "/" . $ponente->imagen_actual . ".png");
                unlink($carpeta_imagenes . "/" . $ponente->imagen_actual . ".webp");
            } else {
                $_POST["imagen"] = $ponente->imagen_actual;
            }

            $_POST["redes"] = json_encode($_POST["redes"], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);

            // Validar
            $alertas = $ponente->validar();

            // Guardar el resgistro
            if(empty($alertas)){
                // Si se agrego una imagen nueva
                if(isset($nombre_imagen)){
                    // Guardar las imagenes
                    $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");
                }

                // Guardar en la BD
                $resultado = $ponente->guardar();

                if($resultado){
                    header("Location: /admin/ponentes");
                }
            }
        }

        $router->render("/admin/ponentes/editar", [
            "titulo" => "Actualizar Ponente",
            "alertas" => $alertas,
            "ponente" => $ponente,
            "redes" => json_decode($ponente->redes)
        ]);
    }

    public static function eliminar(){
        if(!is_admin()){
            header("Location: /login");
            return;
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
            $ponente = Ponente::find($id);

            if(!isset($ponente)){
                header("Location: /admin/ponentes");               
            }

            $carpeta_imagenes = "../public/img/speakers/";
            $imagen_nombre = $ponente->imagen;

            $resultado = $ponente->eliminar();

            if(isset($resultado)){
                unlink($carpeta_imagenes . $imagen_nombre . ".png");
                unlink($carpeta_imagenes . $imagen_nombre . ".webp");
                
                header("Location: /admin/ponentes"); 
            }
        }
    }
}