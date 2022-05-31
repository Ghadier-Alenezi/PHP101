<!DOCTYPE html>
<html>

<head>
    <title>My blog</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="../CSS/styles.css">
</head>

<body>
    <div class="container">
    <header>
        <h1>My Blog</h1>
    </header>

    <nav>
        <ul class="nav">

            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>

            <?php if (Auth::isLoggedIn()) : ?>

                <li class="nav-item"><a class="nav-link" href="/admin/">Admin Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/logout.php">Log out</a></li>

            <?php else : ?>

                <li class="nav-item"><a class="nav-link" href="/login.php">Log in</a></li>

            <?php endif; ?>
        </ul>
    </nav>
    <main>