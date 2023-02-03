<?php

namespace Classes;

class Paginacion{
    public $pagina_actual;
    public $registros_por_pagina;
    public $total_registros;

    public function __construct($pagina_actual = 1, $registros_por_pagina = 10, $total_registros = 0)
    {
        $this->pagina_actual = (int) $pagina_actual;
        $this->registros_por_pagina = (int) $registros_por_pagina;
        $this->total_registros = (int) $total_registros;
    }

    public function offset(){
        return $this->registros_por_pagina * ($this->pagina_actual - 1);
    }

    public function total_paginas(){
        return ceil($this->total_registros / $this->registros_por_pagina);
    }

    public function pagina_anterior(){
        $anterior = $this->pagina_actual - 1;
        return ($anterior > 0) ? $anterior : false;
    }

    public function pagina_siguiente(){
        $siguiente = $this->pagina_actual + 1;
        return ($siguiente <= $this->total_paginas()) ? $siguiente : false;
    }
    
    // Funcion que agrega el Select de elementos por pagina
    public function seleccion_registros(){
        $html = "";
        $html .= "<div class='paginacion__seleccion'>";
        $html .= "<label class='paginacion__texto' for='epp'>Elementos por página:</label>";
        $html .= "
            <select class='paginacion__select' name='epp' id='epp'>
                <option class='paginacion__option' value='5'" . (5 == $this->registros_por_pagina ? 'selected' : '') . ">5</option>
                <option class='paginacion__option' value='10'" . (10 == $this->registros_por_pagina ? 'selected' : '') . ">10</option>
                <option class='paginacion__option' value='25'" . (25 == $this->registros_por_pagina ? 'selected' : '') . ">25</option>
                <option class='paginacion__option' value='50'" . (50 == $this->registros_por_pagina ? 'selected' : '') . ">50</option>
            </select>";     
        $html .= "</div>";
        return $html;
    }

    public function enlace_anterior(){
        $html = ""; 
        if($this->pagina_anterior()){
            $html .= "<a class='paginacion__enlace paginacion__enlace--texto' href='?page={$this->pagina_anterior()}&epp={$this->registros_por_pagina}'>&laquo; Anterior</a>"; // Modificado para mantener cantidad de elementos
        }
        return $html;
    }

    public function enlace_siguiente(){
        $html = ""; 
        if($this->pagina_siguiente()){
            $html .= "<a class='paginacion__enlace paginacion__enlace--texto' href='?page={$this->pagina_siguiente()}&epp={$this->registros_por_pagina}'>Siguiente &raquo;</a>"; // Modificado para mantener cantidad de elementos
        }
        return $html;
    }

    public function numeros_paginas(){
        $html = "";
        for($i = 1; $i <= $this->total_paginas(); $i++){
            if($i == $this->pagina_actual){
                $html .= "<span class='paginacion__enlace paginacion__enlace--actual'>{$i}</span>";
            } else{
                $html .= "<a class='paginacion__enlace paginacion__enlace--numero' href='?page={$i}&epp={$this->registros_por_pagina}'>{$i}</a>";
            }
        }
        return $html;
    }
/*  
    // Original del Curso
    public function paginacion(){
        $html = "";
        if($this->total_registros > 1){ 
            $html .= '<div class="paginacion">';
            $html .= $this->enlace_anterior();
            $html .= $this->numeros_paginas();
            $html .= $this->enlace_siguiente();
            $html .= '</div>';
        }   
        return $html;
    }
*/
  
    // Modificada para hacer Dinamico los Elementos por Pagina
    public function paginacion(){
        $html = "";
        if($this->total_registros > 1){ 
            $html .= '<div class="paginacion">';
            $html .= $this->seleccion_registros(); // Agregado por mi
            $html .= '<div class="paginacion__enlaces">'; // Agregado por mi
            $html .= $this->enlace_anterior();
            $html .= $this->numeros_paginas();
            $html .= $this->enlace_siguiente();
            $html .= '</div>';
            $html .= '</div>'; // Agregado por mi
        }   
        return $html;
    }
}
