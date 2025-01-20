<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 10/01/2025 
 */

class ErrorApp {
    private $codError;
    private $descError;
    private $archivoError;
    private $lineaError;
    
    public function __construct($codError, $descError, $archivoError, $lineaError) {
        $this->codError = $codError;
        $this->descError = $descError;
        $this->archivoError = $archivoError;
        $this->lineaError = $lineaError;
    }
    
    public function getCodError() {
        return $this->codError;
    }

    public function getDescError() {
        return $this->descError;
    }

    public function getArchivoError() {
        return $this->archivoError;
    }

    public function getLineaError() {
        return $this->lineaError;
    }
}