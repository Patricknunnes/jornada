<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
  <!-- <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/2a33fe9a00.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <script src="https://apis.google.com/js/api:client.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <title><?php echo $title ?></title>
  <script>
    var googleUser = {};
    var startApp = function() {
      gapi.load('auth2', function() {
        // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
          client_id: '17890980418-1pe7e87hdgrhs408mb3mo13ogpl3trn1.apps.googleusercontent.com',
          cookiepolicy: 'single_host_origin',
          // Request scopes in addition to 'profile' and 'email'
          //scope: 'additional_scope'
        });
        attachSignin(document.getElementById('customBtn'));
      });
    };


    var startApp1 = function() {
      gapi.load('auth2', function() {
        // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
          client_id: '17890980418-1pe7e87hdgrhs408mb3mo13ogpl3trn1.apps.googleusercontent.com',
          cookiepolicy: 'single_host_origin',
          // Request scopes in addition to 'profile' and 'email'
          //scope: 'additional_scope'
        });
        attachSignup(document.getElementById('customBtn1'));
      });
    };

    function attachSignin(element) {
      console.log(element.id);
      auth2.attachClickHandler(element, {},
        function(googleUser) {
          var nameGoogle = googleUser.getBasicProfile().getName();
          var email = googleUser.getBasicProfile().getEmail();
          var token = googleUser.getBasicProfile().getId();
          $.ajax({
            url: '<?php echo $this->config->base_url(); ?>index.php/login/store2/',
            type: "POST",
            data: {
              nameGoogle: nameGoogle,
              email: email,
              token: token
            },
            success: function(data) {
              if (data != 'error') {
                window.location.href = '<?php echo $this->config->base_url(); ?>index.php/termos'
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Você não possui uma conta cadastrada na plataforma. <?php echo '<br>'; ?> Crie sua conta!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = ""
                  }
                })
              }

            }
          })
        },
        function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
    }



    function attachSignup(element) {
      console.log(element.id);
      auth2.attachClickHandler(element, {},
        function(googleUser) {
          var nameGoogle = googleUser.getBasicProfile().getName();
          var email = googleUser.getBasicProfile().getEmail();
          var token = googleUser.getBasicProfile().getId();
          $.ajax({
            url: '<?php echo $this->config->base_url(); ?>index.php/login/gravar2/',
            type: "POST",
            data: {
              nameGoogle: nameGoogle,
              email: email,
              token: token
            },
            success: function(data) {
              if (data != 'error') {

                Swal.fire({
                  icon: 'success',
                  title: 'Conta criada com sucesso, agora você pode fazer login',
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = '<?php echo $this->config->base_url(); ?>index.php/login'
                  }
                })

              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Não foi possível criar sua conta pois esse email já esta cadastrado'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = ""
                  }
                })
              }

            }
          })
        },
        function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
    }
  </script>

</head>

<body>