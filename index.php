<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Estudiantes - Panel Principal</title>
    <style>
        :root {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color-scheme: light dark;
        }

        body {
            margin: 0;
            background: #f3f4f6;
            color: #111827;
        }

        .navbar {
            background: #111827;
            color: #f9fafb;
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-title {
            font-size: 18px;
            font-weight: 600;
        }

        .navbar-subtitle {
            font-size: 12px;
            opacity: 0.8;
        }

        .navbar-right {
            font-size: 12px;
            opacity: 0.8;
        }

        .page {
            max-width: 960px;
            margin: 32px auto;
            padding: 0 16px 40px;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px 20px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        }

        h1 {
            margin: 0 0 4px;
            font-size: 22px;
        }

        .subtitle {
            margin: 0 0 20px;
            font-size: 13px;
            color: #6b7280;
        }

        .top-actions {
            margin-bottom: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .button-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 999px;
            border: none;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #f9fafb;
            font-size: 13px;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.35);
            transition: transform 0.08s ease, box-shadow 0.08s ease, background 0.12s ease;
        }

        .button-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(37, 99, 235, 0.45);
            background: linear-gradient(135deg, #1d4ed8, #1d4ed8);
        }

        .button-primary:active {
            transform: translateY(0);
            box-shadow: 0 6px 14px rgba(37, 99, 235, 0.3);
        }

        .counter {
            font-size: 12px;
            color: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
            font-size: 13px;
        }

        thead {
            background: #f9fafb;
        }

        th, td {
            padding: 10px 10px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #6b7280;
        }

        tbody tr:hover {
            background: #f3f4ff;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            padding: 4px 9px;
            border-radius: 999px;
            background: #e5f2ff;
            color: #1d4ed8;
            font-size: 11px;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-link {
            font-size: 12px;
            text-decoration: none;
            padding: 4px 8px;
            border-radius: 999px;
            border: 1px solid transparent;
            transition: background 0.12s ease, color 0.12s ease, border-color 0.12s ease;
        }

        .btn-edit {
            color: #1d4ed8;
            border-color: rgba(37, 99, 235, 0.25);
            background: rgba(219, 234, 254, 0.5);
        }

        .btn-edit:hover {
            background: #1d4ed8;
            color: #f9fafb;
        }

        .btn-delete {
            color: #b91c1c;
            border-color: rgba(220, 38, 38, 0.25);
            background: rgba(254, 226, 226, 0.7);
        }

        .btn-delete:hover {
            background: #b91c1c;
            color: #f9fafb;
        }

        .empty {
            margin-top: 10px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #f9fafb;
            font-size: 13px;
            color: #6b7280;
        }

        @media (max-width: 720px) {
            .card {
                padding: 18px 14px;
            }
            th:nth-child(3),
            td:nth-child(3) {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="navbar">
    <div>
        <div class="navbar-title">Gestión de Estudiantes</div>
        <div class="navbar-subtitle">Tarea 3 – Git y Git Flow</div>
    </div>
    <div class="navbar-right">
        Programación III
    </div>
</div>

<div class="page">
    <div class="card">
        <h1>Gestión de Estudiantes registrados</h1>
        <p>Desde este panel puedes crear, editar y eliminar estudiantes del sistema.</p>
        <p class="subtitle">CRUD sencillo para la gestión de estudiantes almacenados en la base de datos.</p>

        <div class="top-actions">
            <a href="create.php" class="button-primary">
                <span>+</span>
                <span>Nuevo estudiante</span>
            </a>
            <div class="counter">
                Total registrados: <?php echo count($students); ?>
            </div>
        </div>

        <?php if (count($students) === 0): ?>
            <div class="empty">
                Todavía no hay estudiantes registrados. Usa el botón "Nuevo estudiante" para agregar el primero.
            </div>
        <?php else: ?>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Carrera</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['id']); ?></td>
                        <td><?php echo htmlspecialchars($student['name']); ?></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td><span class="chip"><?php echo htmlspecialchars($student['career']); ?></span></td>
                        <td>
                            <div class="actions">
                                <a href="edit.php?id=<?php echo $student['id']; ?>" class="btn-link btn-edit">Editar</a>
                                <a href="delete.php?id=<?php echo $student['id']; ?>" class="btn-link btn-delete">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
