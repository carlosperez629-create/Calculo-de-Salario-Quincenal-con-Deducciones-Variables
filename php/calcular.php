<?php
const TARIFA_DIURNA = 675;
const TARIFA_VESPERTINA = 700;
const TARIFA_NOCTURNA = 956.23;

function formatear($valor)
{
    return number_format($valor, 2, ',', '.') . ' Bs.';
}

function obtenerPorcentajes($bruto)
{
    if ($bruto < 85000) {
        return ['habitacional' => 0.1, 'seguro' => 0.15];
    }

    if ($bruto <= 150000) {
        return ['habitacional' => 0.15, 'seguro' => 0.2];
    }

    return ['habitacional' => 0.3, 'seguro' => 0.25];
}

$nombre = trim($_POST['nombre'] ?? '');
$cedula = trim($_POST['cedula'] ?? '');
$diurna = $_POST['diurna'] ?? '';
$vespertina = $_POST['vespertina'] ?? '';
$nocturna = $_POST['nocturna'] ?? '';

$valido = $nombre !== ''
    && $cedula !== ''
    && is_numeric($diurna) && $diurna >= 0
    && is_numeric($vespertina) && $vespertina >= 0
    && is_numeric($nocturna) && $nocturna >= 0;

if ($valido) {
    $bruto = $diurna * TARIFA_DIURNA
        + $vespertina * TARIFA_VESPERTINA
        + $nocturna * TARIFA_NOCTURNA;

    $porcentajes = obtenerPorcentajes($bruto);
    $descuentoHabitacional = $bruto * $porcentajes['habitacional'] / 100;
    $descuentoSeguro = $bruto * $porcentajes['seguro'] / 100;
    $neto = $bruto - $descuentoHabitacional - $descuentoSeguro;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <main class="contenedor">
        <h1>Resultado del Cálculo</h1>

        <?php if (!$valido): ?>
            <p class="error">Datos incompletos o inválidos. Verifique el formulario.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Nombre</th>
                    <td class="monto"><?= htmlspecialchars($nombre) ?></td>
                </tr>
                <tr>
                    <th>Cédula</th>
                    <td class="monto"><?= htmlspecialchars($cedula) ?></td>
                </tr>
                <tr>
                    <th>Sueldo bruto</th>
                    <td class="monto"><?= formatear($bruto) ?></td>
                </tr>
                <tr>
                    <th>Ahorro Habitacional (<?= $porcentajes['habitacional'] ?>%)</th>
                    <td class="monto">- <?= formatear($descuentoHabitacional) ?></td>
                </tr>
                <tr>
                    <th>Seguro Social (<?= $porcentajes['seguro'] ?>%)</th>
                    <td class="monto">- <?= formatear($descuentoSeguro) ?></td>
                </tr>
                <tr class="total">
                    <th>Sueldo neto</th>
                    <td class="monto"><?= formatear($neto) ?></td>
                </tr>
            </table>
        <?php endif; ?>

        <a class="boton" href="../index.html">Nuevo cálculo</a>
    </main>
</body>
</html>
