<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="../css/toast.css">
    </head>
  <body>
    <div class="container">
      <!-- section-success -->
      <div class="wrapper-success">
        <div class="card">
          <div class="icon"><i class="fas fa-check-circle"></i></div>
          <div class="subject">
            <h3 class="titulo">Success</h3>
            <p class="paragrafo">Anyone with access can view your invited visitors</p>
          </div>
          <div class="icon-times" ><i onClick="fecharToast()" class="fas fa-times"></i></div>
        </div>
      </div>
      <!-- section-success -->

      <!-- section-info -->
      <div class="wrapper-info">
        <div class="card">
          <div class="icon"><i class="fas fa-info-circle"></i></div>
          <div class="subject">
            <h3>Info</h3>
            <p>Anyone with access can view your invited visitors</p>
          </div>
          <div class="icon-times"><i class="fas fa-times"></i></div>
        </div>
      </div>
      <!-- section-info -->

      <!-- section-warning -->
      <div class="wrapper-warning">
        <div class="card">
          <div class="icon"><i class="fas fa-exclamation-circle"></i></div>
          <div class="subject">
            <h3>Warning</h3>
            <p>Anyone with access can view your invited visitors</p>
          </div>
          <div class="icon-times"><i class="fas fa-times"></i></div>
        </div>
      </div>
      <!-- section-warning -->
    </div>

    <script src="../javascript/toast.js"></script>
  </body>
</html>
