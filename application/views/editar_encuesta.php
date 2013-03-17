<!DOCTYPE html>
<html lang="es">
<head>
  <?php include 'templates/head.php'?>
  <title><?php echo $tituloFormulario.' - '.NOMBRE_SISTEMA?></title>
  <script src="<?php echo base_url('js/bootstrap-typeahead.js')?>"></script>
</head>
<body>
  <div id="wrapper">
    <?php include 'templates/menu-nav.php'?>
    <div class="container">
      <div class="row">
        <!-- Titulo -->
        <div class="span12">
          <h3>Gestión de Encuestas</h3>
          <p>---Descripción---</p>
        </div>
      </div>
      
      <div class="row">
        <!-- SideBar -->
        <div class="span3" id="menu">
          <?php $item_submenu = 1;
            include 'templates/submenu-encuestas.php';
          ?>
        </div>
        
        <!-- Main -->
        <div class="span9">
          <form action="<?php echo $urlFormulario?>" method="post">
            <div class="control-group">
              <div class="controls">
                <h4><?php echo $tituloFormulario?></h4>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="campoTipo">Tipo de acceso: <span class="opcional">*</span></label>
              <div class="controls">
                <select id="campoTipo" name="tipo" required>
                  <option value="<?php echo TIPO_ANONIMA?>">Anónima</option>
                </select>
                <?php echo form_error('tipo')?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="buscarFormulario">Formulario: <span class="opcional">*</span></label>
              <div class="controls">
                <input class="input-block-level" id="buscarFormulario" type="text" autocomplete="off" value="<?php echo $formulario->nombre?>" />
                <input type="hidden" name="idFormulario" value="<?php echo $encuesta->idFormulario?>"/>
                <?php echo form_error('idFormulario')?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="campoAnio">Año: <span class="opcional">*</span></label>
              <div class="controls">
                <input class="input-block-level" id="campoAnio" type="number" name="anio" min="1900" max="2100" step="1" value="<?php echo (set_value('anio'))?set_value('anio'):$encuesta->año?>"/>
                <?php echo form_error('anio')?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="campoCuatrimestre" title="Período/Cuatrimestre"><?php echo PERIODO?>: <span class="opcional">*</span></label>
              <div class="controls">
                <input class="input-block-level" id="campoCuatrimestre" type="number" name="cuatrimestre" min="1" step="1" value="<?php echo (set_value('cuatrimestre'))?set_value('cuatrimestre'):$encuesta->cuatrimestre?>" />
                <?php echo form_error('cuatrimestre')?>
              </div>
            </div>
            <!-- Botones -->
            <div class="control-group">
              <div class="controls">
                <input class="btn btn-primary" type="submit" name="submit" value="Aceptar" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id="push"></div><br />
  </div>
  <?php include 'templates/footer.php'?>
  
  <script src="<?php echo base_url('js/bootstrap-transition.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-modal.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-collapse.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-dropdown.js')?>"></script>
  <script src="<?php echo base_url('js/formularios.js')?>"></script>
  <script src="<?php echo base_url('js/autocompletar.js')?>"></script>
  <script>
    autocompletar_formulario("<?php echo site_url('formularios/buscarAJAX')?>");
  </script>
</body>
</html>