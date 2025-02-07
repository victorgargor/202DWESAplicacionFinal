<?php
/**
 * @author Alex Asensio Sánchez, Víctor García Gordón
 * @version Fecha de última modificación 29/01/2025
 */

/**
 * Clase ErrorApp
 * 
 * Esta clase se utiliza para representar los errores que ocurren durante la ejecución de la aplicación.
 * Contiene información detallada sobre el error, como el código, la descripción, el archivo donde ocurrió,
 * la línea en la que se produjo y la página a la que se redirigirá al usuario tras el error.
 */
class ErrorApp {
    
    /**
     * @var int $codError Código del error.
     */
    private $codError;
    
    /**
     * @var string $descError Descripción del error.
     */
    private $descError;
    
    /**
     * @var string $archivoError Archivo en el que ocurrió el error.
     */
    private $archivoError;
    
    /**
     * @var int $lineaError Línea donde se produjo el error.
     */
    private $lineaError;
    
    /**
     * @var string $paginaSiguiente Página a la que el usuario será redirigido tras el error.
     */
    private $paginaSiguiente;

    /**
     * Constructor de la clase ErrorApp.
     * 
     * Inicializa un objeto ErrorApp con los detalles del error.
     * 
     * @param int $codError Código del error.
     * @param string $descError Descripción del error.
     * @param string $archivoError Archivo donde ocurrió el error.
     * @param int $lineaError Línea donde ocurrió el error.
     * @param string $paginaSiguiente Página a la que el usuario será redirigido tras el error.
     */
    public function __construct($codError, $descError, $archivoError, $lineaError, $paginaSiguiente) {
        $this->codError = $codError;
        $this->descError = $descError;
        $this->archivoError = $archivoError;
        $this->lineaError = $lineaError;
        $this->paginaSiguiente = $paginaSiguiente;
    }
    
    /**
     * Obtiene el código del error.
     * 
     * @return int Código del error.
     */
    public function getCodError() {
        return $this->codError;
    }

    /**
     * Obtiene la descripción del error.
     * 
     * @return string Descripción del error.
     */
    public function getDescError() {
        return $this->descError;
    }

    /**
     * Obtiene el archivo en el que ocurrió el error.
     * 
     * @return string Archivo donde ocurrió el error.
     */
    public function getArchivoError() {
        return $this->archivoError;
    }

    /**
     * Obtiene la línea en la que ocurrió el error.
     * 
     * @return int Línea donde ocurrió el error.
     */
    public function getLineaError() {
        return $this->lineaError;
    }

    /**
     * Obtiene la página a la que el usuario será redirigido tras el error.
     * 
     * @return string Página siguiente a la que se redirige al usuario.
     */
    public function getPaginaSiguiente() {
        return $this->paginaSiguiente;
    }

    /**
     * Establece el código del error.
     * 
     * @param int $codError El código del error.
     */
    public function setCodError($codError): void {
        $this->codError = $codError;
    }

    /**
     * Establece la descripción del error.
     * 
     * @param string $descError La descripción del error.
     */
    public function setDescError($descError): void {
        $this->descError = $descError;
    }

    /**
     * Establece el archivo donde ocurrió el error.
     * 
     * @param string $archivoError El archivo donde ocurrió el error.
     */
    public function setArchivoError($archivoError): void {
        $this->archivoError = $archivoError;
    }

    /**
     * Establece la línea donde ocurrió el error.
     * 
     * @param int $lineaError La línea donde ocurrió el error.
     */
    public function setLineaError($lineaError): void {
        $this->lineaError = $lineaError;
    }

    /**
     * Establece la página a la que el usuario será redirigido tras el error.
     * 
     * @param string $paginaSiguiente La página a la que se redirige al usuario.
     */
    public function setPaginaSiguiente($paginaSiguiente): void {
        $this->paginaSiguiente = $paginaSiguiente;
    }
}
