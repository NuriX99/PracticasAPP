<?php
require_once 'Cliente.php';

$Cliente = new Cliente();
$Cliente = $Cliente->getCliente();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obtener Clientes</title>
</head>
<body>
    <h1>Clientes</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($Cliente)): ?>
                <?php foreach ($Cliente as $Cliente): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($Cliente['id']); ?></td>
                        <td><a href="<?php echo htmlspecialchars($Cliente['link']); ?>" target="_blank"><?php echo htmlspecialchars($Cliente['link']); ?></a></td>
                        <td>
                           
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Se produjo un error, no se encontraron clientes.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>


