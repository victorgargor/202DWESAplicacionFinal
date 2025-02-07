<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 30/01/2025
 */

/**
 * Clase Departamento
 * 
 * Representa un departamento dentro de la aplicación. Esta clase gestiona los detalles del departamento,
 * incluyendo su código, descripción, fecha de creación, volumen de negocio y fecha de baja.
 */
class Departamento {
    private $codDepartamento;            // Código único del departamento
    private $descDepartamento;           // Descripción del departamento
    private $fechaCreacionDepartamento; // Fecha de creación del departamento
    private $volumenDeNegocio;          // Volumen de negocio asociado al departamento
    private $fechaBajaDepartamento;     // Fecha en que el departamento fue dado de baja

    /**
     * Constructor de la clase Departamento.
     * 
     * Inicializa los atributos del departamento con los valores proporcionados.
     *
     * @param string $codDepartamento El código único del departamento.
     * @param string $descDepartamento La descripción del departamento.
     * @param string $fechaCreacionDepartamento La fecha de creación del departamento.
     * @param float $volumenDeNegocio El volumen de negocio asociado al departamento.
     * @param string $fechaBajaDepartamento La fecha en que el departamento fue dado de baja (si aplica).
     */
    public function __construct($codDepartamento, $descDepartamento, $fechaCreacionDepartamento, $volumenDeNegocio, $fechaBajaDepartamento) {
        $this->codDepartamento = $codDepartamento;
        $this->descDepartamento = $descDepartamento;
        $this->fechaCreacionDepartamento = $fechaCreacionDepartamento;
        $this->volumenDeNegocio = $volumenDeNegocio;
        $this->fechaBajaDepartamento = $fechaBajaDepartamento;
    }

    /**
     * Obtiene el código del departamento.
     *
     * @return string El código del departamento.
     */
    public function getCodDepartamento() {
        return $this->codDepartamento;
    }

    /**
     * Obtiene la descripción del departamento.
     *
     * @return string La descripción del departamento.
     */
    public function getDescDepartamento() {
        return $this->descDepartamento;
    }

    /**
     * Obtiene la fecha de creación del departamento.
     *
     * @return string La fecha de creación del departamento.
     */
    public function getFechaCreacionDepartamento() {
        return $this->fechaCreacionDepartamento;
    }

    /**
     * Obtiene el volumen de negocio asociado al departamento.
     *
     * @return float El volumen de negocio del departamento.
     */
    public function getVolumenDeNegocio() {
        return $this->volumenDeNegocio;
    }

    /**
     * Obtiene la fecha de baja del departamento.
     *
     * @return string La fecha de baja del departamento (si aplica).
     */
    public function getFechaBajaDepartamento() {
        return $this->fechaBajaDepartamento;
    }

    /**
     * Establece el código del departamento.
     *
     * @param string $codDepartamento El nuevo código del departamento.
     */
    public function setCodDepartamento($codDepartamento): void {
        $this->codDepartamento = $codDepartamento;
    }

    /**
     * Establece la descripción del departamento.
     *
     * @param string $descDepartamento La nueva descripción del departamento.
     */
    public function setDescDepartamento($descDepartamento): void {
        $this->descDepartamento = $descDepartamento;
    }

    /**
     * Establece la fecha de creación del departamento.
     *
     * @param string $fechaCreacionDepartamento La nueva fecha de creación del departamento.
     */
    public function setFechaCreacionDepartamento($fechaCreacionDepartamento): void {
        $this->fechaCreacionDepartamento = $fechaCreacionDepartamento;
    }

    /**
     * Establece el volumen de negocio del departamento.
     *
     * @param float $volumenDeNegocio El nuevo volumen de negocio del departamento.
     */
    public function setVolumenDeNegocio($volumenDeNegocio): void {
        $this->volumenDeNegocio = $volumenDeNegocio;
    }

    /**
     * Establece la fecha de baja del departamento.
     *
     * @param string $fechaBajaDepartamento La nueva fecha de baja del departamento.
     */
    public function setFechaBajaDepartamento($fechaBajaDepartamento): void {
        $this->fechaBajaDepartamento = $fechaBajaDepartamento;
    }
}
