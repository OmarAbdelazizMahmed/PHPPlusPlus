<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php env('APP_NAME') ?></title>
    <!-- tailwind -->
</head>
<body>
<!-- container -->
    <?php include  view_path() . '/partials/navbar.php' ?>
    <div class="container mx-auto">
        {{ content }}
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>