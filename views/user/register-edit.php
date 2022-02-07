<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="Lib/bootstrap/css/bootstrap.min.css" />
    
</head>
<body>
    <?php
      $editar=false;
      $id = isset($_GET['id']) ? $_GET['id'] : false;
      if($id){
        $usuario = Utils::getUsuario($id);
        $editar=true;
      }
      if($editar){
        $titulo = "Editar Usuario";
      }else{$titulo = "Resgistrar Usuario";}
      Utils::getProvincias();
    ?>
    <div class="container">
        <div class="row m-auto col-lg-8 bg-light">
            <h3 class="col-12 m-auto"><?=$titulo?></h3>
            <div id="msj"></div>
          <form class="row g-3 p-4" id="formUser">
            <input type="hidden" name="id" value="<?= isset($usuario->id) ? $usuario->id : false ?>"/>
            <div class="col-md-4">
                <label for="validationDefault01" class="form-label">nombre(*)</label>
                <input type="text" class="form-control" id="validationDefault01" value="<?= isset($usuario->nombre) ? $usuario->nombre : '' ?>" required name="nombre">
            </div>
            <div class="col-md-4">
                <label for="validationDefault02" class="form-label">Apellido(*)</label>
                <input type="text" class="form-control" id="validationDefault02" value="<?= isset($usuario->apellido) ? $usuario->apellido : '' ?>" required name="apellido">
            </div>
            <div class="col-md-4">
                <label for="validationDefaultUsername" class="form-label">Username(*)</label>
                <div class="input-group">
                  <span class="input-group-text" id="inputGroupPrepend2">@</span>
                  <input type="email" class="form-control" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" required value="<?= isset($usuario->username) ? $usuario->username : '' ?>" name="username">
                </div>
            </div>
            <div class="col-md-6">
              <label for="validationDefault03" class="form-label">Contraseña(*)</label>
              <input type="password" class="form-control" id="validationDefault03" required name="password">
            </div>
            <div class="col-md-6">
              <label for="validationDefault04" class="form-label">Provincia</label>
              <?php $provincias = Utils::getProvincias();?>
              <select class="form-select" id="validationDefault04" name="provincia">
                <?php foreach($provincias as $provincia): ?>
                    <?php foreach($provincia as $valor): ?>
                        <option <?= isset($usuario->id_provincia) && $usuario->id_provincia == $valor['id'] ? "selected" : '' ?> value="<?=$valor['id']?>"><?= $valor['nombre_completo']?></option>
                    <?php endforeach;?>
                <?php endforeach; ?>
              </select>
              
            </div>
            <div class="col-md-6">
              <label for="validationDefault05" class="form-label">Número (1-100)</label>
              <input type="number" min="1" max="100" class="form-control" id="validationDefault05" value="<?= isset($usuario->numero) ? $usuario->numero : '' ?>" name="numero">
            </div>
            <div class="col-md-6">
              <label for="validationDefault05" class="form-label">Fecha(*)</label>
              <input type="date" class="form-control" id="validationDefault05" value="<?= isset($usuario->fecha) ? $usuario->fecha : '' ?>" name="fecha" required>
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" <?= isset($usuario->acepta_terminos) && $usuario->acepta_terminos == 1 ? "checked" : '' ?> value="1" id="invalidCheck2" name="terminos">
                <label class="form-check-label" for="invalidCheck2">
                  Aceptar terminos y condiciones
                </label>
              </div>
            </div>
            <div class="col-2">
              <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
            <div id="preload" class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
            </div>
           
        </form>
    </div>
    </div>
    <script src="Lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="Lib/js/app.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>