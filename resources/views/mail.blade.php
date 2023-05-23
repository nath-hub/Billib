<html>

<head>
  <title>Titre du document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      margin: 150px;
      background-color: #cecece;
    }

    #but {
      background-color: #3f3f3e;
      border: none;
      color: #ffffff;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 20px;
    }

    .hello {
      font-size: 20px;
      padding-left: 100px;
      padding-right: 100px;
      padding-top: 50px;
    }

    .button {
      text-align: center;
      margin: 20px;
      
    }

    .icone {
      text-align: center;
      padding-top: 20px;
      padding-bottom: 20px;
      background-color: #fcbd00;
      height: 100px;
      width: 100%;
    }

    p {
      margin-top: 50px;
      text-align: center;
      color: black;
    }

    p a {
      text-decoration: none;
      color: #fcbd00;
       font-weight: 700;
    }
    
    button a {
      text-decoration: none;
      color: white;
    }

    .boy {
      background-color: white;
      text-align: center;
    }


    .corp{
      height: 100%;
      width: 100%;
      margin-left: 10px;
    }
    img{
      border-radius: 50%;
      border: 3px solid white;
    }
  </style>
</head>

<body>
  <div class="boy">

    <div class="icone">
      <img src="https://raw.githubusercontent.com/nath-hub/caisse0/main/public/logo.png" height="100" width="100">
    </div>
    <div class="corp">
      <h1>CONFIRMATION DE L'ADRESSE E-MAIL </h1>

      <div class="hello">
        Hello. Veuillez cliquer sur le bouton ci-dessous pour activer votre compte sur <strong> Bill'lib</strong>
      </div>
      <p style="display:none"></p>

      <div class="button">
        <button id="but"><a href='http://billib.fr/api/update-code'>Valider mon compte </a> </button>
      </div>


      <p>&copy; 2023 <a href="billib.fr" >bill'lib</a></p>
    </div>
  </div>
</body>

</html>