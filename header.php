<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Escolar</title>
    <!-- Tipografía Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: #eef2ff;
            --slate-900: #0f172a;
            --slate-800: #1e293b;
            --slate-600: #475569;
            --slate-500: #64748b;
            --slate-200: #e2e8f0;
            --slate-100: #f1f5f9;
            --slate-50: #f8fafc;
            --danger: #ef4444;
            --danger-hover: #dc2626;
            --danger-bg: #fef2f2;
            --radius-lg: 16px;
            --radius-md: 10px;
            --shadow-card: 0 10px 25px -5px rgba(15, 23, 42, 0.08), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background: linear-gradient(180deg, #f8fafc 0%, #eef2f6 100%);
            color: var(--slate-800);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Barra de navegación superior */
        .top-navbar {
            width: 100%;
            background: #ffffff;
            border-bottom: 1px solid var(--slate-200);
            padding: 0.85rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            margin-bottom: 2rem;
        }

        .nav-brand {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--slate-900);
            letter-spacing: -0.02em;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-brand span {
            color: var(--primary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-badge {
            background-color: var(--primary-light);
            color: var(--primary);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Botón de Cerrar Sesión en Navbar */
        .btn-nav-logout {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background-color: var(--danger-bg);
            color: var(--danger);
            border: 1px solid #fee2e2;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            margin: 0 !important;
        }

        .btn-nav-logout:hover {
            background-color: var(--danger);
            color: #ffffff;
            border-color: var(--danger);
            text-decoration: none !important;
        }

        /* Tarjeta / Contenedor principal */
        .container {
            background: #ffffff;
            width: 100%;
            max-width: 640px;
            padding: 40px 36px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            border: 1px solid rgba(226, 232, 240, 0.9);
            margin-bottom: 40px;
        }

        h1 {
            color: var(--slate-900);
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            margin-bottom: 1.5rem;
            text-align: center;
            background: linear-gradient(135deg, var(--slate-900) 0%, #374151 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        h2 {
            color: var(--slate-800);
            font-size: 1.1rem;
            font-weight: 700;
            margin: 1.8rem 0 0.9rem 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        h2::before {
            content: "";
            display: inline-block;
            width: 4px;
            height: 18px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        p {
            margin: 0.5rem 0;
            font-size: 0.95rem;
            color: var(--slate-600);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 9px 14px;
            background: var(--slate-50);
            border-radius: 8px;
            border: 1px solid #f1f5f9;
        }

        p strong {
            color: var(--slate-800);
            font-weight: 600;
            font-size: 0.88rem;
        }

        hr {
            border: none;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--slate-200), transparent);
            margin: 2rem 0 1rem 0;
        }

        /* Tabla de calificaciones */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 1.2rem 0;
            border: 1px solid var(--slate-200) !important;
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        th, td {
            padding: 14px 18px;
            text-align: left;
            font-size: 0.92rem;
        }

        th {
            background-color: var(--slate-100);
            color: var(--slate-600);
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--slate-200) !important;
            border-left: none !important;
            border-right: none !important;
            border-top: none !important;
        }

        td {
            border-bottom: 1px solid var(--slate-100) !important;
            border-left: none !important;
            border-right: none !important;
            border-top: none !important;
            color: var(--slate-800);
        }

        tr:last-child td {
            border-bottom: none !important;
        }

        tr:hover td {
            background-color: #fafbfc;
        }

        /* Formularios e inputs */
        form {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-top: 15px;
        }

        label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--slate-600);
            margin-bottom: -6px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid var(--slate-200);
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            color: var(--slate-900);
            background-color: #ffffff;
            outline: none;
            transition: all 0.2s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="number"]:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light);
        }

        button,
        input[type="submit"] {
            background-color: var(--primary);
            color: #ffffff;
            border: none;
            padding: 13px 20px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: var(--radius-md);
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25);
            transition: all 0.2s ease;
        }

        button:hover,
        input[type="submit"]:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        a {
            display: inline-block;
            margin-top: 16px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            text-align: center;
        }

        a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        /* Footer */
        .site-footer {
            width: 100%;
            padding: 24px 0;
            margin-top: auto;
            border-top: 1px solid var(--slate-200);
            background: #ffffff;
            text-align: center;
        }

        .site-footer p {
            background: transparent;
            border: none;
            display: block;
            font-size: 0.82rem;
            color: var(--slate-500);
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <header class="top-navbar">
        <a href="dashboard.php" class="nav-brand">
            Portal<span>Escolar</span>
        </a>
        <div class="nav-actions">
            <?php if (isset($_SESSION["usuario_id"])): ?>
                <span class="nav-badge">Estudiante</span>
                <a href="logout.php" class="btn-nav-logout">Cerrar sesión</a>
            <?php else: ?>
                <span class="nav-badge">Acceso</span>
            <?php endif; ?>
        </div>
    </header>

    <div class="container">