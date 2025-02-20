<html><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - CAT</title>
  <link rel="shortcut icon" href="<?= base_url()?>assets/images/biro-sdm-ico.ico">
  <style>
  @font-face { font-family: Arial !important; font-display: swap !important; }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
  ::-webkit-scrollbar {
    width: 8px;
  }
  /* Track */
  ::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #888;
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #555;
    } /* Importing fonts from Google */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

    /* Reseting */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #ecf0f3;
    }

    .wrapper {
      max-width: 350px;
      min-height: 500px;
      margin: 80px auto;
      padding: 40px 30px 30px 30px;
      background-color: #ecf0f3;
      border-radius: 15px;
      box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
    }

    .logo {
      width: 80px;
      margin: auto;
    }

    .logo img {
      width: 100%;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      box-shadow: 0px 0px 3px #5f5f5f,
      0px 0px 0px 5px #ecf0f3,
      8px 8px 15px #a7aaa7,
      -8px -8px 15px #fff;
    }

    .wrapper .name {
      font-weight: 600;
      font-size: 1.4rem;
      letter-spacing: 1.3px;
      padding-left: 10px;
      color: #555;
    }

    .wrapper .form-field input {
      width: 100%;
      display: block;
      border: none;
      outline: none;
      background: none;
      font-size: 1.2rem;
      color: #666;
      padding: 10px 15px 10px 10px;
      /* border: 1px solid red; */
    }

    .wrapper .form-field {
      padding-left: 10px;
      margin-bottom: 20px;
      border-radius: 20px;
      box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
    }

    .wrapper .form-field .fas {
      color: #555;
    }

    .wrapper .btn {
      box-shadow: none;
      width: 100%;
      height: 40px;
      background-color: #2f6120;
      color: #fff;
      border-radius: 25px;
      box-shadow: 3px 3px 3px #b1b1b1,
      -3px -3px 3px #fff;
      letter-spacing: 1.3px;
    }

    .wrapper .btn:hover {
      background-color: #039BE5;
    }

    .wrapper a {
      text-decoration: none;
      font-size: 0.8rem;
      color: #03A9F4;
    }

    .wrapper a:hover {
      color: #039BE5;
    }

    @media(max-width: 380px) {
      .wrapper {
        margin: 30px 20px;
        padding: 40px 15px 15px 15px;
      }
      }</style>
    </head>
    <body classname="snippet-body">
      <div class="wrapper" style="max-width: 400px;">
        <div class="logo">
          <img src="https://www.freepnglogos.com/uploads/logo-depag-png/file-kementerian-agama-logo-wikimedia-commons-1.png" alt="">
        </div>
        <div class="text-center mt-4 name">
          Computer Assisted Test
        </div>
        <?php if(session()->getFlashdata('message')){ ?>
        <p class="text-center text-danger"><?= session()->getFlashdata('message')?></p>
        <?php } ?>
        <form class="p-3 mt-3" method="post" action="">
          <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="text" name="nik" id="nik" placeholder="NIP">
          </div>
          <!--<div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="nomor_peserta" id="nomor_peserta" placeholder="Nomor Peserta">
          </div>-->
          <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="text" name="pinsesi" id="pinsesi" placeholder="PIN Ujian">
          </div>
          <button class="btn mt-3">Login</button>
        </form>
      </div>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
