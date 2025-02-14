<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 13/02/2025
 */
?>
<header>      
    <h1 id="inicio">Mto Departamentos</h1>
</header>
<!-- Formulario de búsqueda -->
<form class="busqueda" method="post">
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo isset($_SESSION['descripcionBuscada']) ? $_SESSION['descripcionBuscada'] : ''; ?>">
    </div>

    <!-- Radio buttons para el estado -->
    <div class="form-group">
        <label class="estado" for="estado">Estado:</label>
        
        <input type="radio" id="estadoTodos" name="estado" value="todos" <?php echo (isset($_SESSION['estadoFiltro']) && $_SESSION['estadoFiltro'] == 'todos') ? 'checked' : ''; ?>>
        <label class="todos" for="estadoTodos">Todos</label>
   
        <input type="radio" id="estadoActivos" name="estado" value="activos" <?php echo (isset($_SESSION['estadoFiltro']) && $_SESSION['estadoFiltro'] == 'activos') ? 'checked' : ''; ?>>
        <label class="activos" for="estadoActivos">Activos</label>
        
        <input type="radio" id="estadoBaja" name="estado" value="baja" <?php echo (isset($_SESSION['estadoFiltro']) && $_SESSION['estadoFiltro'] == 'baja') ? 'checked' : ''; ?>>
        <label class="baja" for="estadoBaja">Baja</label>
    </div>

    <button type="submit" name="buscar">Buscar</button>
</form>
<!-- Tabla de departamentos -->
<table style="width: 1000px; border-collapse: collapse; background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
    <thead>
        <tr>
            <th style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f6f8fa; font-weight: 600;">Código</th>
            <th style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f6f8fa; font-weight: 600;">Descripción</th>
            <th style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f6f8fa; font-weight: 600;">Fecha Alta</th>
            <th style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f6f8fa; font-weight: 600;">Volumen de Negocio</th>
            <th style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f6f8fa; font-weight: 600;">Fecha Baja</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($departamentos)): ?>
            <tr>
                <td colspan="5" style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f9f9f9;">No se encontraron departamentos.</td>
            </tr>
        <?php else: ?>
            <?php
            foreach ($departamentos as $oDepartamento):
                // Verificamos si el departamento tiene fecha de baja
                $isBaja = $oDepartamento->T02_FechaBajaDepartamento != null; // Si tiene fecha de baja, está dado de baja
                $fechaBaja = $isBaja ? $oDepartamento->T02_FechaBajaDepartamento : null; // Fecha de baja si está dado de baja
                ?>
                <tr>
                    <td style="padding: 8px; text-align: center; border: 1px solid #e1e4e8;"><?php echo $oDepartamento->T02_CodDepartamento; ?></td>
                    <td style="padding: 8px; text-align: center; border: 1px solid #e1e4e8;"><?php echo $oDepartamento->T02_DescDepartamento; ?></td>
                    <td style="padding: 8px; text-align: center; border: 1px solid #e1e4e8;"><?php echo date_format(new DateTime($oDepartamento->T02_FechaCreacionDepartamento), 'd/m/Y'); ?></td>
                    <td style="padding: 8px; text-align: center; border: 1px solid #e1e4e8;"><?php echo number_format($oDepartamento->T02_VolumenDeNegocio, 2, '.', '.'); ?> €</td>
                    <td style="padding: 8px; text-align: center; border: 1px solid #e1e4e8;">
                        <?php echo $oDepartamento->T02_FechaBajaDepartamento ? date_format(new DateTime($oDepartamento->T02_FechaBajaDepartamento), 'd/m/Y') : 'Activo'; ?>
                    </td>
                    <td colspan="2" style="padding: 8px; text-align: center; border: 1px solid #e1e4e8;">
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="codDepartamento" value="<?php echo $oDepartamento->T02_CodDepartamento; ?>">
                            <button type="submit" name="consultarModificar" style="border: none; background: none; cursor: pointer;">
                                <img src="webroot/media/images/editar.png" alt="editar" style="width: 40px; margin-right: 5px;">
                            </button>
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="codDepartamento" value="<?php echo $oDepartamento->T02_CodDepartamento; ?>">
                            <button type="submit" name="ver" style="border: none; background: none; cursor: pointer;">
                                <img src="webroot/media/images/ver.png" alt="ver" style="width: 40px; margin-right: 5px;">
                            </button>
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="codDepartamento" value="<?php echo $oDepartamento->T02_CodDepartamento; ?>">
                            <button type="submit" name="eliminar" style="border: none; background: none; cursor: pointer;">
                                <img src="webroot/media/images/eliminar.png" alt="eliminar" style="width: 40px; margin-right: 5px;">
                            </button>
                        </form>                               
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="codDepartamento" value="<?php echo $oDepartamento->T02_CodDepartamento; ?>">
                            <?php if ($oDepartamento->T02_FechaBajaDepartamento): ?>
                                <!-- Si el departamento está de baja, mostrar la opción de rehabilitar -->
                                <button type="submit" name="rehabilitar" style="border: none; background: none; cursor: pointer;">
                                    <img src="webroot/media/images/rehabilitar.png" alt="rehabilitar" style="width: 40px; margin-right: 5px;">
                                </button>
                            <?php else: ?>
                                <!-- Si el departamento está activo, mostrar la opción de baja lógica -->
                                <button type="submit" name="bajaLogica" style="border: none; background: none; cursor: pointer;">
                                    <img src="webroot/media/images/bajalogica.png" alt="baja" style="width: 40px; margin-right: 5px;">
                                </button>
                            <?php endif; ?>
                        </form>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
</table>
<div style="display: flex; justify-content: center; margin-top: 10px;">
    <div>
        <!-- Formulario para ir a la primera página -->
        <form action="" method="POST" style="display: inline;">
            <input type="hidden" name="paginaPrimera" value="true">
            <button type="submit" style="border: none; background: none; padding: 5px; cursor: pointer;">
                <img src="webroot/media/images/inicio.png" alt="Inicio" style="width: 40px; height: 40px;">
            </button>
        </form>

        <!-- Formulario para retroceder una página -->
        <form action="" method="POST" style="display: inline;">
            <input type="hidden" name="paginaAnterior" value="true">
            <button type="submit" style="border: none; background: none; padding: 5px; cursor: pointer;">
                <img src="webroot/media/images/atras.png" alt="Atrás" style="width: 40px; height: 40px;">
            </button>
        </form>

        <!-- Mostrar el número de página actual y total de páginas -->
        <span style="margin: 0 10px; font-size: 16px; line-height: 40px;">
            <?php echo $_SESSION['pagina']; ?> de <?php echo $totalPaginas; ?>
        </span>

        <!-- Formulario para avanzar una página -->
        <form action="" method="POST" style="display: inline;">
            <input type="hidden" name="paginaSiguiente" value="true">
            <button type="submit" style="border: none; background: none; padding: 5px; cursor: pointer;">
                <img src="webroot/media/images/adelante.png" alt="Adelante" style="width: 40px; height: 40px;">
            </button>
        </form>

        <!-- Formulario para ir a la última página -->
        <form action="" method="POST" style="display: inline;">
            <input type="hidden" name="paginaUltima" value="true">
            <button type="submit" style="border: none; background: none; padding: 5px; cursor: pointer;">
                <img src="webroot/media/images/fin.png" alt="Fin" style="width: 40px; height: 40px;">
            </button>
        </form>
    </div>
</div>
<div style="display: flex; justify-content: center; margin-top: 10px;">
    <form method="post" name="añadir" style="display:inline;">
        <button type="submit" name="añadir" style="border: none; background: none; cursor: pointer;">
            <img src="webroot/media/images/añadir.png" alt="añadir" style="width: 40px; margin-right: 5px;">
        </button>
    </form>
</div>
<!-- Botón para exportar departamentos a XML -->
<div style="display: flex; justify-content: center; margin-top: 10px;">
    <form method="post" style="display: flex; align-items: center;">
        <button type="submit" name="exportar" style="border: none; background: none; cursor: pointer; display: flex; align-items: center;">
            <img src="webroot/media/images/exportar.png" alt="Exportar XML" style="width: 40px; margin-right: 8px;">
            <span style="font-size: 16px; font-weight: bold;">Exportar Departamentos</span>
        </button>
    </form>
</div>
<!-- Botón para importar departamentos desde XML -->
<div style="display: flex; justify-content: center; margin-top: 10px;">
    <form method="post" enctype="multipart/form-data" style="display: flex; align-items: center;">
        <label for="archivoXML" style="cursor: pointer; display: flex; align-items: center;">
            <img src="webroot/media/images/importar.png" alt="Importar XML" style="width: 40px; margin-right: 8px;">
            <span style="font-size: 16px; font-weight: bold;">Importar Departamentos</span>
        </label>
        <input type="file" id="archivoXML" name="archivoXML" accept=".xml" style="display: block; margin-left: 10px">
        <button type="submit" name="importar" style="border: none; background: none; cursor: pointer;">
            <img src="webroot/media/images/subir.png" alt="Subir XML" style="width: 40px; margin-left: 8px;">
        </button>
    </form>
</div>
<?php if (isset($_SESSION['mensajeImportacion'])): ?>
    <div class="alert">
        <?php echo $_SESSION['mensajeImportacion']; ?>
    </div>
    <?php unset($_SESSION['mensajeImportacion']); // Limpiar el mensaje ?>
<?php endif; ?>
<form method="post">
    <input type="submit" name="volver" value="Volver">
</form>