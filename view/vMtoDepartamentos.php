<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 30/01/2025
 */
?>
<header>      
    <h1 id="inicio">Mto Departamentos</h1>
</header>
<!-- Formulario de búsqueda -->
<form class="busqueda" method="post">
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo isset($_POST['descripcion']) ? $_POST['descripcion'] : ''; ?>">
        <button type="submit" name="buscar">Buscar</button>
    </div>
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
        <?php if (empty($departamentosPagina)): ?>
            <tr>
                <td colspan="5" style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f9f9f9;">No se encontraron departamentos.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($departamentosPagina as $oDepartamento): 
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
        <a href="?pagina=1" style="margin: 0 5px; padding: 5px; text-decoration: none;">
            <img src="webroot/media/images/inicio.png" alt="Inicio" style="width: 40px; height: 40px;">
        </a>

        <a href="?pagina=<?php echo $paginaActual > 1 ? $paginaActual - 1 : 1; ?>" style="margin: 0 5px; padding: 5px; text-decoration: none;">
            <img src="webroot/media/images/atras.png" alt="Atrás" style="width: 40px; height: 40px;">
        </a>

        <a href="?pagina=<?php echo $paginaActual < $totalPaginas ? $paginaActual + 1 : $totalPaginas; ?>" style="margin: 0 5px; padding: 5px; text-decoration: none;">
            <img src="webroot/media/images/adelante.png" alt="Adelante" style="width: 40px; height: 40px;">
        </a>

        <a href="?pagina=<?php echo $totalPaginas; ?>" style="margin: 0 5px; padding: 5px; text-decoration: none;">
            <img src="webroot/media/images/fin.png" alt="Fin" style="width: 40px; height: 40px;">
        </a>
    </div>
</div>
<div style="display: flex; justify-content: center; margin-top: 10px;">
    <form method="post" name="añadir" style="display:inline;">
        <button type="submit" name="añadir" style="border: none; background: none; cursor: pointer;">
            <img src="webroot/media/images/añadir.png" alt="añadir" style="width: 40px; margin-right: 5px;">
        </button>
    </form>
</div>
<form method="post">
    <input type="submit" name="volver" value="Volver">
</form>