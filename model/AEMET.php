<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 27/01/2025 
 */
class AEMET{
    private $tiempo;
    
    public function __construct($tiempo) {
        $this->tiempo = $tiempo;
    }
    
    public function getTiempo() {
        return $this->tiempo;
    }

    public function setTiempo($tiempo): void {
        $this->tiempo = $tiempo;
    }
}