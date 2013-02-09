<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
  <?php include 'elements/head.php'?> 
  <title>Generar Informe por Materia</title>
</head>
<body>
  <!-- Header -->
  <div class="row">
    <div class="twelve columns">
      <?php include 'elements/header.php'?>
    </div>
  </div>

  <div class="row">
    <!-- Nav Sidebar -->
    <div class="three columns">
      <!-- Panel de navegación -->
      <?php include 'elements/nav-sidebar.php'?>
    </div>
    
    <!-- Main Section -->  
    <div id="Main" class="nine columns">
      <h3>Solicitar informe por asignatura</h3>
      <form action="<?php echo site_url('encuestas/generarInformeMateria')?>" method="post">
        <div class="row">
          <div class="twelve columns">
            <label for="buscarCarrera">Carrera: </label>
            <div class="buscador">
              <input id="buscarCarrera" type="text" autocomplete="off">
              <i class="gen-enclosed foundicon-search"></i>
              <select id="listaCarreras" name="idCarrera" size="3" required>
              </select>
              <?php echo form_error('idCarrera')?>
            </div>

            <label for="buscarMateria">Materia: </label>
            <div class="buscador">
              <input id="buscarMateria" type="text" autocomplete="off">
              <i class="gen-enclosed foundicon-search"></i>
              <select id="listaMaterias" name="idMateria" size="3" required>
              </select>
              <?php echo form_error('idMateria')?>
            </div>

            <label for="buscarEncuesta">Año: </label>
            <div class="buscador">
              <input id="buscarEncuesta" type="text" autocomplete="off">
              <i class="gen-enclosed foundicon-search"></i>
              <select id="listaEncuestas" name="encuesta" size="3" required>
              </select>
              <?php echo form_error('encuesta')?>
            </div>
          </div>
          <div class="twelve columns">
            <div class="row">    
              <input type="checkbox" name="indicesSecciones" />Incluir promedio de índices de secciones
            </div>
            <div class="row">    
              <input type="checkbox" name="indicesDocentes" />Incluir promedio de índices para cada docente
            </div>
            <div class="row">    
              <input type="checkbox" name="indicesGeneral" />Incluir indice general
            </div>
          </div>
        </div>
        <div class="row">         
          <div class="three mobile-two columns centered pull-one-mobile">
            <input class="button" type="submit" name="submit" value="Aceptar" />
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->    
  <div class="row">    
    <?php include 'elements/footer.php'?>
  </div>
  
  <!-- Included JS Files (Compressed) -->
  <script src="<?php echo base_url()?>js/foundation/foundation.min.js"></script>
  <!-- Initialize JS Plugins -->
  <script src="<?php echo base_url()?>js/foundation/app.js"></script>
  
  <script>
    //realizo la busqueda de carreras por AJAX
    $('#buscarCarrera').keyup(function(){
      $.ajax({
        type: "POST", 
        url: "<?php echo site_url('carreras/buscarAJAX')?>", 
        data: { buscar: $(this).val() }
      }).done(function(msg){
        $('#listaCarreras').empty();
        var filas = msg.split("\n");
        for (var i=0; i<filas.length-1; i++){
          if (filas[i].length<5) continue;
          //separo datos en columnas
          var columnas = filas[i].split("\t");
          var id = columnas[0];
          var datos = columnas[1]+" / "+columnas[2];
          //agregar fila a la lista desplegable
          $('#listaCarreras').append('<option value="'+id+'">'+datos+'</option>');
        }
        $('#listaCarreras').children().first().attr('selected','');
      });
    });
    
    //realizo la busqueda de materias por AJAX
    $('#buscarMateria').keyup(function(){
      $.ajax({
        type: "POST", 
        url: "<?php echo site_url('carreras/buscarMateriasAJAX')?>", 
        data: { 
          idCarrera: $('#listaCarreras').val(),
          buscar: $(this).val() 
        }
      }).done(function(msg){
        $('#listaMaterias').empty();
        var filas = msg.split("\n");
        for (var i=0; i<filas.length-1; i++){
          if (filas[i].length<5) continue;
          //separo datos en columnas
          var columnas = filas[i].split("\t");
          var id = columnas[0];
          var datos = columnas[1]+" / "+columnas[2];
          //agregar fila a la lista desplegable
          $('#listaMaterias').append('<option value="'+id+'">'+datos+'</option>');
        }
        $('#listaMaterias').children().first().attr('selected','');
      });
    });
      
    //realizo la busqueda de encuestas por AJAX
    $('#buscarEncuesta').keyup(function(){
      $.ajax({
        type: "POST", 
        url: "<?php echo site_url('encuestas/buscarEncuestaAJAX')?>", 
        data: { buscar: $(this).val() }
      }).done(function(msg){
        $('#listaEncuestas').empty();
        var filas = msg.split("\n");
        for (var i=0; i<filas.length-1; i++){
          if (filas[i].length<5) continue;
          //separo datos en columnas
          var columnas = filas[i].split("\t");
          var id = columnas[0]+"_"+columnas[1];
          var datos = columnas[2]+"/"+columnas[3];
          //agregar fila a la lista desplegable
          $('#listaEncuestas').append('<option value="'+id+'">'+datos+'</option>');
        }
        $('#listaEncuestas').children().first().attr('selected','');
      });
    });






    $('#listaCarreras').change(function(){
      texto = $(this).children('option[selected]').text();
      $('#buscarCarrera').val(texto);
      //$(this).next('small.error').hide('fast');
    });
    
    
    
    
    
    

    var solicitarCarreras = function(){
      if ($('#listaMaterias').val() == '') return;
      $.ajax({
        type: "POST", 
        url: "<?php echo site_url('materias/listarCarrerasAJAX')?>", 
        data:{ idMateria: $('#listaMaterias').val() }
      }).done(function(msg){
        $('#listaCarreras').empty();
        var filas = msg.split("\n");
        for (var i=0; i<filas.length; i++){
          if (filas[i].length<5) continue;
          //separo datos en columnas
          var columnas = filas[i].split("\t");
          var id = columnas[0];
          var datos = columnas[1] +' ('+columnas[2]+')';
          //agregar fila a la lista desplegable
          $('#listaCarreras').append('<option value="'+id+'">'+datos+'</option>');
        }
      });
    };

    //lleno la lista de carreras al seleccionar la materia
    $('#listaMaterias').change(solicitarCarreras);

    //lleno la lista de carreras por primera vez al cargar la pagina
    solicitarCarreras();
  </script>
</body>
</html>