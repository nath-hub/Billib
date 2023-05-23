<html>

<head>
  <title>Titre du document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      margin: 150px;
      background-color: black;
    }

    #but {
      background-color: white;
      border: none;
      color: #fcbd00;
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
      height: 100px;
      width: 100%;
    }

    p {
      margin-top: 50px;
      text-align: center;
      color: white;
    }

    p a {
      text-decoration: none;
      color: #fcbd00 !important;
       font-weight: 700;
    }
    
    button a {
      text-decoration: none;
      color: white !important;
    }

    .boy {
      background-color: black;
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
    h1{
      color: white;
    }
    .hello{
      color: white;
    }
  </style>
</head>

<body>
  <div class="boy">

    <div class="icone">
      <img src="https://raw.githubusercontent.com/nath-hub/caisse0/main/public/logo.png" height="100" width="100">
    </div>
    <div class="corp">
      <h1>Bravo, Votre adresse email a été confirmée !</h1>

      <div class="hello">
       Vous pouvez désormais vous connecter à l’application avec votre identifiant unique qui est le suivant:
      </div>
      

      <div class="button">
        <button id="but">{{$identifiant}} </button>
      </div>


      <p>&copy; 2023 <a href="billib.fr" >bill'lib</a></p>
    </div>
  </div>
</body>

</html>