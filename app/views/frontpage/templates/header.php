<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/bootstrap.min.css">
    <title>Halaman <?= $data['title']; ?></title>
</head>
<body>

<?= $this->view('frontpage/templates/navbar', $data); ?>