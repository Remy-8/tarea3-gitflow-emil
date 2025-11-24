<?php
require_once 'db.php';

$id = $_GET['id'] ?? null;
if ($id === null) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
$stmt->execute([':id' => $id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
        $stmtDelete = $pdo->prepare("DELETE FROM students WHERE id = :id");
        $stmtDelete->execute([':id' => $id]);
    }
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar estudiante</title>
    <style>
        :root {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
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

        .page {
            max-width: 520px;
            margin: 32px auto;
            padding: 0 16px 40px;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px 22px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        }

        h1 {
            margin: 0 0 6px;
            font-size: 20px;
        }

        .subtitle {
            margin: 0 0 18px;
            font-size: 13px;
            color: #6b7280;
        }

        .warning-box {
            background: #fef2f2;
            border-radius: 10px;
            padding: 12px 13px;
            border: 1px solid #fecaca;
            margin-bottom: 18px;
            font-size: 13px;
            color: #991b1b;
        }

        .student-name {
            font-weight: 600;
            color: #111827;
        }

        form {
            display: flex;
            gap: 12px;
            margin-top: 4px;
        }

        .button-danger {
            padding: 9px 16px;
            border-radius: 999px;
            border: none;
            font-size: 13px;
            cursor: pointer;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: #f9fafb;
            box-shadow: 0 8px 18px rgba(220, 38, 38, 0.35);
            transition: transform 0.08s ease, box-shadow 0.08s ease, background 0.12s ease;
        }

        .button-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(220, 38, 38, 0.45);
            background: linear-gradient(135deg, #b91c1c, #b91c1c);
        }

        .button-secondary {
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid #d1d5db;
            background: #ffffff;
            font-size: 13px;
            cursor: pointer;
            color: #374151;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .button-secondary:hover {
            background: #f9fafb;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 14px;
            font-size: 13px;
            text-decoration: none;
            color: #4b5563;
        }

        .back-link:hover {
            color: #111827;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div>
        <div class="navbar-title">Gestión de Estudiantes</div>
        <div class="navbar-subtitle">Confirmación de eliminación</div>
    </div>
</div>

<div class="page">
    <div class="card">
        <a href="index.php" class="back-link">← Volver al listado</a>

        <h1>Eliminar estudiante</h1>
        <p class="subtitle">Esta acción no se puede deshacer.</p>

        <div class="warning-box">
            ¿Seguro que deseas eliminar al estudiante
            <span class="student-name">
                <?php echo htmlspecialchars($student['name']); ?>
            </span>
            del sistema?
        </div>

        <form method="post" action="delete.php?id=<?php echo htmlspecialchars($id); ?>">
            <button type="submit" name="confirm" value="yes" class="button-danger">
                Sí, eliminar
            </button>
            <a href="index.php" class="button-secondary">Cancelar</a>
        </form>
    </div>
</div>
</body>
</html>
