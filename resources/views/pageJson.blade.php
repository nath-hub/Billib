<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="card-body">
 <form method="GET" action="/public/index.php/jsonPage">
    @csrf

   <div class="row mb-3">
        <label for="">nom_magasin</label>
        <input type="text" name="nom_magasin" id="">
    </div>

    <div class="row mb-3">
        <label for="">adresse</label>
        <input type="text" name="adresse" id="">
    </div>

    <div class="row mb-3">
        <label for="">telephone</label>
        <input type="text" name="telephone" id="">
    </div>

    <div class="row mb-3">
        <label for="">numero</label>
        <input type="text" name="numero" id="">
    </div>

    <div class="row mb-3">
        <label for="">caissiere</label>
        <input type="text" name="caissiere" id="">
    </div>

    <div class="row mb-3">
        <label for="">nomArticle</label>
        <input type="text" name="nomArticle" id="">
    </div>

    <div class="row mb-3">
        <label for="">autreModele</label>
        <input type="text" name="autreModele" id="">
    </div>

    <div class="row mb-3">
        <label for="">noticeDoc</label>
        <input type="text" name="noticeDoc" id="">
    </div>

    <div class="row mb-3">
        <label for="">notice</label>
        <input type="text" name="notice" id="">
    </div>

    <div class="row mb-3">
        <label for="">garantie</label>
        <input type="text" name="garantie" id="">
    </div>

    <div class="row mb-3">
        <label for="">tuto</label>
        <input type="text" name="tuto" id="">
    </div>

    <div class="row mb-3">
        <label for="">reparation</label>
        <input type="text" name="reparation" id="">
    </div>

    <div class="row mb-3">
        <label for="">revente</label>
        <input type="text" name="revente" id="">
    </div>

    <div class="row mb-3">
        <label for="">quantite</label>
        <input type="number" name="quantite" id="">
    </div>

    <div class="row mb-3">
        <label for="">pu</label>
        <input type="number" name="pu" id="">
    </div>

    <div class="row mb-3">
        <label for="">categories</label>
        <input type="text" name="categories" id="">
    </div>

    <div class="row mb-3">
        <label for="">montant</label>
        <input type="number" name="montant" id="">
    </div>

    <div class="row mb-3">
        <label for="">net</label>
        <input type="number" name="net" id="">
    </div>

    <div class="row mb-3">
        <label for="">tva</label>
        <input type="number" name="tva" id="">
    </div>

    <div class="row mb-3">
        <label for="">total</label>
        <input type="number" name="total" id="">
    </div>

                        
 <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
        </div>
    </div>
  </form>
 </div>
</body>
</html>
