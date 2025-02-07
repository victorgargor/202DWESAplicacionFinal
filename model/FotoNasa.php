<?php
/**
 * @author Borja Nuñez Refoyo, reutilizado y mejorado por Víctor García Gordón
 * @version Fecha de última modificación 28/01/2025
 */

/**
 * Clase FotoNasa
 * 
 * Esta clase representa una foto de la NASA con su título y URL.
 * La clase permite acceder a los detalles de una foto obtenida de la NASA
 * como su título y la URL de la imagen, así como actualizar dichos valores.
 */
class FotoNasa {
    
    /**
     * @var string $titulo Título de la foto de la NASA.
     */
    private $titulo;
    
    /**
     * @var string $foto URL de la foto de la NASA.
     */
    private $foto;
    
    /**
     * Constructor de la clase FotoNasa.
     * 
     * Inicializa un objeto FotoNasa con el título y la URL de la foto.
     * 
     * @param string $titulo El título de la foto de la NASA.
     * @param string $foto La URL de la foto de la NASA.
     */
    public function __construct($titulo, $foto) {
        $this->titulo = $titulo;
        $this->foto = $foto;
    }
    
    /**
     * Obtiene el título de la foto.
     * 
     * @return string El título de la foto de la NASA.
     */
    public function getTitulo() {
        return $this->titulo;
    }
    
    /**
     * Obtiene la URL de la foto.
     * 
     * @return string La URL de la foto de la NASA.
     */
    public function getFoto() {
        return $this->foto;
    }

    /**
     * Establece el título de la foto.
     * 
     * @param string $titulo El nuevo título para la foto de la NASA.
     */
    public function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }
    
    /**
     * Establece la URL de la foto.
     * 
     * @param string $foto La nueva URL para la foto de la NASA.
     */
    public function setFoto($foto): void {
        $this->foto = $foto;
    }
}
