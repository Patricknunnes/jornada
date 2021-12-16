<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <!-- <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/2a33fe9a00.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title><?php echo $title ?></title>


</head>

<body>
    <div class="container" style="padding-left: 50px; padding-right: 50px;">
        <div style="display: flex; width: 100%; margin-left: 35%; padding-bottom: 30px;">
            <img src="<?= base_url() ?>assets/img/logo_azul.png" style="height: 60px; width: 135px; margin-left: 5%;" />
            <?php foreach ($pages_runs as $pager) { ?>
                <?php if ($pager->run_id = $id_page) { ?>
                    <center>
                        <h3 class="mt-5" style="color:#000; font-size: 18px;"><?php echo $pager->run_titulo; ?></h3>
                    </center>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="container">
            <div class="container" id="main_c">
                <form>

                    <div><?php echo $resultados2; ?></div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>