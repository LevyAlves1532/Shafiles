<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShaFiles</title>
    <script defer src="<?= BASE ?>assets/js/libs/jquery.min.js"></script>
    <link rel="stylesheet" href="<?= BASE; ?>assets/css/fontawesome/css/all.min.css">
    <link rel="stylesheet/less" type="text/css" href="<?= BASE; ?>assets/css/styles.less" />
</head>

<body>

    <!-- Conteudos -->
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>

    <!-- ALERT -->
    <div class="alert-area" id="alert" style="border-bottom: 4px solid #F99700;">
        <div class="header">
            <h3 class="title" id="title-alert" style="color: #F99700">Aviso</h3>

            <button class="btn" id="close-alert" style="background-color: #F99700;">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="middle">
            <p class="text" id="message-alert">Lorem Ipsum</p>
        </div>
    </div>

    <!-- AQUI COLOCAREMOS O FOOTER -->
    <script src="<?= BASE ?>assets/js/libs/less.js"></script>
    <script src="<?= BASE ?>assets/js/scripts.js"></script>

</body>

</html>