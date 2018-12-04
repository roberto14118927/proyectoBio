<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        >

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <title>Hello, world!</title>
    </head>
    <body class="bg-light">
 message from server: {{name}}
        <div class="container">
            <br>
            <div class="row">

                <div class="col-md-12 order-md-1">
                    <h4 class="mb-3 text-center">Registro de Neonatos</h4>
                    <form class="needs-validation" action="../controllers/insert.php" method="post" >
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="firstName">Nombre</label>

        <input name="cmp_nombre" type="text" class="form-control" value="<?php echo !empty($cmp_nombre)?$cmp_nombre:'';?>" required >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lastName">Apellido Paterno</label>
        <input type="text" class="form-control" name="cmp_pat" value="<?php echo !empty($cmp_pat)?$cmp_pat:'';?>" required >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lastName">Apellido Materno</label>
        <input type="text" class="form-control" name="cmp_mat" value="<?php echo !empty($cmp_mat)?$cmp_mat:'';?>" required >
                            </div>
                        </div>

                        <div style="text-align: center !important;">
                            <button
                                class="btn btn-primary btn-lg btn"
                                type="submit"
                            >
                                Guardar
                            </button>

                        </div>

                    </form>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Paterno</th>
                                <th scope="col">Materno</th>
                                <th scope="col">accion</th>
                            </tr>
                        
                        </thead>

                        <tbody>
                        <?php
                            include '../conection/conection.php';
                            $pdo =  Database::connect();
                            $sql = 'SELECT * FROM Tbl_test1 ORDER BY id DESC';
                            foreach($pdo->query($sql) as $row){
                                echo '<tr>';
                                echo '<td>'.$row['id'].'</td>';
                                echo '<td>'.$row['cmp_nombre'].'</td>';
                                echo '<td>'.$row['cmp_pat'].'</td>';
                                echo '<td>'.$row['cmp_mat'].'</td>';
                                echo '<td><a class="btn btn-success" href="../views/editar.php?id='.$row['id'].'">Editar</a> </td>';
                                echo '</tr>';
                            }
                            Database::disconnect();
                        ?>

                        </tbody>

                    </table>
                </div>
            </div>

            <footer class="my-5 pt-5 text-muted text-center text-small">
                <p class="mb-1">Proyecto Neonatal</p>
                <ul class="list-inline">
                    <p>Biomedica</p>
                </ul>
            </footer>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"
        ></script>
        <script>
            window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
        </script>
        <script src="../../assets/js/vendor/popper.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <script src="../../assets/js/vendor/holder.min.js"></script>
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
          (function() {
            'use strict';
    
            window.addEventListener('load', function() {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');
    
              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
        </script>
    </body>
</html>
