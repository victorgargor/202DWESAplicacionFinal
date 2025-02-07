<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 08/01/2025
 */

/**
 * Clase Usuario
 * 
 * Representa a un usuario en el sistema. Contiene información sobre su identificación, 
 * detalles de acceso, perfil, y otros atributos asociados al usuario.
 */
class Usuario {
    private $codUsuario;
    private $password;
    private $descUsuario;
    private $numAccesos;
    private $fechaHoraUltimaConexion;
    private $fechaHoraUltimaConexionAnterior;
    private $perfil;  
    private $imagenUsuario;
    
    /**
     * Constructor de la clase Usuario.
     * 
     * Inicializa todos los atributos del usuario con los valores proporcionados.
     *
     * @param string $codUsuario Código único del usuario.
     * @param string $password Contraseña del usuario.
     * @param string $descUsuario Descripción o nombre del usuario.
     * @param int $numAccesos Número de accesos realizados por el usuario.
     * @param string $fechaHoraUltimaConexion Fecha y hora de la última conexión.
     * @param string $fechaHoraUltimaConexionAnterior Fecha y hora de la conexión anterior.
     * @param string $perfil Perfil del usuario (ejemplo: administrador, normal).
     * @param string $imagenUsuario Imagen de perfil del usuario.
     */
    public function __construct($codUsuario, $password, $descUsuario, $numAccesos, $fechaHoraUltimaConexion, $fechaHoraUltimaConexionAnterior, $perfil, $imagenUsuario) {
        $this->codUsuario = $codUsuario;
        $this->password = $password;
        $this->descUsuario = $descUsuario;
        $this->numAccesos = $numAccesos;
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
        $this->fechaHoraUltimaConexionAnterior = $fechaHoraUltimaConexionAnterior;
        $this->perfil = $perfil;
        $this->imagenUsuario = $imagenUsuario;
    }
    
    /**
     * Obtiene el código único del usuario.
     *
     * @return string Código del usuario.
     */
    public function getCodUsuario() {
        return $this->codUsuario;
    }

    /**
     * Obtiene la contraseña del usuario.
     *
     * @return string Contraseña del usuario.
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Obtiene la descripción o nombre del usuario.
     *
     * @return string Descripción del usuario.
     */
    public function getDescUsuario() {
        return $this->descUsuario;
    }

    /**
     * Obtiene el número de accesos realizados por el usuario.
     *
     * @return int Número de accesos.
     */
    public function getNumAccesos() {
        return $this->numAccesos;
    }

    /**
     * Obtiene la fecha y hora de la última conexión del usuario.
     *
     * @return string Fecha y hora de la última conexión.
     */
    public function getFechaHoraUltimaConexion() {
        return $this->fechaHoraUltimaConexion;
    }

    /**
     * Obtiene la fecha y hora de la conexión anterior del usuario.
     *
     * @return string Fecha y hora de la conexión anterior.
     */
    public function getFechaHoraUltimaConexionAnterior() {
        return $this->fechaHoraUltimaConexionAnterior;
    }

    /**
     * Obtiene el perfil del usuario.
     *
     * @return string Perfil del usuario (ejemplo: administrador, normal).
     */
    public function getPerfil() {
        return $this->perfil;
    }

    /**
     * Obtiene la imagen del usuario.
     *
     * @return string Imagen de perfil del usuario.
     */
    public function getImagenUsuario() {
        return $this->imagenUsuario;
    }

    /**
     * Establece el código único del usuario.
     *
     * @param string $codUsuario Código del usuario.
     */
    public function setCodUsuario($codUsuario): void {
        $this->codUsuario = $codUsuario;
    }

    /**
     * Establece la contraseña del usuario.
     *
     * @param string $password Contraseña del usuario.
     */
    public function setPassword($password): void {
        $this->password = $password;
    }

    /**
     * Establece la descripción o nombre del usuario.
     *
     * @param string $descUsuario Descripción del usuario.
     */
    public function setDescUsuario($descUsuario): void {
        $this->descUsuario = $descUsuario;
    }

    /**
     * Establece el número de accesos realizados por el usuario.
     *
     * @param int $numAccesos Número de accesos.
     */
    public function setNumAccesos($numAccesos): void {
        $this->numAccesos = $numAccesos;
    }

    /**
     * Establece la fecha y hora de la última conexión del usuario.
     *
     * @param string $fechaHoraUltimaConexion Fecha y hora de la última conexión.
     */
    public function setFechaHoraUltimaConexion($fechaHoraUltimaConexion): void {
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
    }

    /**
     * Establece la fecha y hora de la conexión anterior del usuario.
     *
     * @param string $fechaHoraUltimaConexionAnterior Fecha y hora de la conexión anterior.
     */
    public function setFechaHoraUltimaConexionAnterior($fechaHoraUltimaConexionAnterior): void {
        $this->fechaHoraUltimaConexionAnterior = $fechaHoraUltimaConexionAnterior;
    }

    /**
     * Establece el perfil del usuario.
     *
     * @param string $perfil Perfil del usuario (ejemplo: administrador, normal).
     */
    public function setPerfil($perfil): void {
        $this->perfil = $perfil;
    }

    /**
     * Establece la imagen del usuario.
     *
     * @param string $imagenUsuario Imagen de perfil del usuario.
     */
    public function setImagenUsuario($imagenUsuario): void {
        $this->imagenUsuario = $imagenUsuario;
    }
}
