<?php
require_once 'db.php';

$name = '';
$email = '';
$career = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $career = trim($_POST['career'] ?? '');

    if ($name === '') {
        $errors[] = 'El nombre es obligatorio.';
    }
    if ($email === '') {
        $errors[] = 'El email es obligatorio.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'El email no tiene un formato válido.';
    }
    if ($career === '') {
        $errors[] = 'La carrera es obligatoria.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO students (name, email, career) VALUES (:name, :email, :career)");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':career' => $career,
        ]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo estudiante</title>
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
            max-width: 640px;
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
            margin: 0 0 4px;
            font-size: 20px;
        }

        .subtitle {
            margin: 0 0 18px;
            font-size: 13px;
            color: #6b7280;
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

        form {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-top: 6px;
        }

        label {
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 2px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 9px 10px;
            border-radius: 9px;
            border: 1px solid #d1d5db;
            font-size: 13px;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.12s ease, box-shadow 0.12s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 1px rgba(37, 99, 235, 0.35);
        }

        .field-group {
            display: flex;
            flex-direction: column;
        }

        .error-box {
            background: #fef2f2;
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 12px;
            border: 1px solid #fecaca;
            color: #b91c1c;
            font-size: 13px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 18px;
        }

        .actions {
            margin-top: 8px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .button-primary {
            padding: 9px 18px;
            border-radius: 999px;
            border: none;
            font-size: 13px;
            cursor: pointer;
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: #f9fafb;
            box-shadow: 0 8px 18px rgba(22, 163, 74, 0.35);
            transition: transform 0.08s ease, box-shadow 0.08s ease, background 0.12s ease;
        }

        .button-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(22, 163, 74, 0.45);
            background: linear-gradient(135deg, #15803d, #15803d);
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
        }

        .button-secondary:hover {
            background: #f9fafb;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div>
        <div class="navbar-title">Gestión de Estudiantes</div>
        <div class="navbar-subtitle">Nuevo registro</div>
    </div>
</div>

<div class="page">
    <div class="card">
        <a href="index.php" class="back-link">← Volver al listado</a>

        <h1>Crear estudiante</h1>
        <p class="subtitle">Completa los campos para registrar un nuevo estudiante en el sistema.</p>

        <?php if (!empty($errors)): ?>
            <div class="error-box">
                <ul>
                    <?php foreach ($errors as $e): ?>
                        <li><?php echo htmlspecialchars($e); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="create.php">
            <div class="field-group">
                <label for="name">Nombre completo</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>"placeholder="Ej: Juan Pérez">
            </div>

            <div class="field-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>"placeholder="Ej: juan@example.com">
            </div>

            <div class="field-group">
                <label for="career">Carrera</label>
                <input type="text" name="career" id="career" value="<?php echo htmlspecialchars($career); ?>"placeholder="Ej: Desarrollo de Software">
            </div>

            <div class="actions">
                <button type="submit" class="button-primary">Guardar estudiante</button>
                <a href="index.php" class="button-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
