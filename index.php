<!doctype html>
<html lang="en">

<head>
  <title>Test Laboral</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link href="./style.css" rel="stylesheet">
</head>

<body>
  <main>
    <br />

    <div class="container">
      <div class="row">
        <div class="col">
          <h5>TEST DE ESTRES LABORAL</h5>
          Permite conocer en que grado el trabajador padece los simtomas asociados al estres.
          <br />
          <strong>Instrucciones:</strong>
          De los siguientes sintomas, selecciona el grado experimentado durante los ultimos 3 meses de acuerdo al
          semaforo presentado.
          <br />
          <span class="badge color1">1 (Nunca)</span>
          <span class="badge color2">2 (Casi Nunca)</span>
          <span class="badge color3">3 (Pocas veces)</span>
          <span class="badge color4">4 (Algunas veces)</span>
          <span class="badge color5">5 (Relativamente Frecuente)</span>
          <span class="badge color6">6 (Muy frecuente)</span>

          <br /><br />
          <form method="post" action="index.php">
            <?php
            $preguntas = [
              "Imposibilidad de concilar el sueño",
              "Jaquecas y dolores de cabeza",
              "Indigestiones o molestias gastrointerntinales",
              "Sensacion de cansancio extremo o agotamiento",
              "Disminucion del interez sexual",
              "Respiracion entrecortada o sensacion de ahogo",
              "Disminucion del apetito",
              "Temblores musculares",
              "Pinchazos o sensaciones dolorosas en distintas partes del cuerpo",
              "Tentaciones fuertes de no levantarse por la mañana",
              "Tendencias a sudar o palpitaciones"
            ];

            ?>
            <div class="card">
              <div class="card-body">
                <?php
                foreach ($preguntas as $index => $pregunta) {  ?>
                  <span class="badge bg-light text-dark">
                    <?php echo $index + 1; ?>.
                  </span>
                  <?php echo $pregunta; ?>

                  <br />
                  <?php for ($opcion = 1; $opcion <= 6; $opcion++) { ?>
                    <span class="badge color<?php echo $opcion; ?>">
                      <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="radio" name="pregunta<?php echo $index; ?>" id=""
                          value="<?php echo $opcion; ?>" required />
                        <label class="form-check-label" for=""><?php echo $opcion; ?></label>
                      </div>
                    </span>
                  <?php } ?>

                  <br />

                <?php } ?>

              </div>
            </div>
            <br />
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary">
                Enviar Respuestas
              </button>
            </div>
            <br />
        </div>
        <div class="col">
          <h5>Respuesta
          </h5>
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $respuestas = [];
            $numeroPreguntas = count($preguntas);
            for ($i = 0; $i < $numeroPreguntas; $i++) {
              $respuesta = isset($_POST["pregunta$i"]) ? (int)$_POST["pregunta$i"] : 0;
              $respuestas[] = $respuesta;
            }
            $puntajeTotal = array_sum($respuestas);
            $colorClase = ''; // Definir una variable para la clase de color

            if ($puntajeTotal <= 12) {
              $nivelEstress = "Sin estrés";
              $mensaje = "No existe síntoma alguno de estrés.";
              $colorClase = 'bg-success'; // Verde
            } elseif ($puntajeTotal <= 24) {
              $nivelEstress = "Sin estrés";
              $mensaje = "Tienes un buen equilibrio, continúa así y contagia a los demás de tus estrategias de afrontamiento!";
              $colorClase = 'bg-success'; // Verde
            } elseif ($puntajeTotal <= 36) {
              $nivelEstress = "Estrés leve";
              $mensaje = "Te encuentras en fase de alarma, trata de identificar el o los factores que te causan estrés para poder ocuparte de ellos de manera preventiva.";
              $colorClase = 'bg-warning'; // Amarillo
            } elseif ($puntajeTotal <= 48) {
              $nivelEstress = "Estrés medio";
              $mensaje = "Haz conciencia de la situación en la que te encuentras y trata de ubicar qué puedes modificar, ya que si la situación estresante se prolonga, puedes romper tu equilibrio entre lo laboral y lo personal. ¡No agotes tus resistencias!";
              $colorClase = 'bg-warning'; // Amarillo
            } elseif ($puntajeTotal <= 60) {
              $nivelEstress = "Estrés alto";
              $mensaje = "Te encuentras en una fase de agotamiento de recursos fisiológicos con desgaste físico y mental. Esto puede tener consecuencias más serias para tu salud.";
              $colorClase = 'bg-danger'; // Rojo
            } else {
              $nivelEstress = "Estrés grave";
              $mensaje = "Busca ayuda";
              $colorClase = 'bg-danger'; // Rojo
            }
            echo "<div class='card $colorClase text-white'>";
            echo "<div class='card-body'>";
            echo "<strong>Puntaje obtenido: </strong>" . $puntajeTotal;
            echo "<br> <strong>Nivel de Estrés: </strong>" . $nivelEstress;
            echo "<br> <strong>Mensaje: </strong>" . $mensaje;
            echo "</div>";
            echo "</div>";
          }
          ?>
        </div>
      </div>
    </div>
    </form>
  </main>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
  </script>
</body>

</html>