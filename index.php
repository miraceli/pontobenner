<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Ponto Benner</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">

  <script type="text/javascript">
      function submitForm(acao){
        if(acao == 'ambiental'){
          document.forms.selecao.action="processaAmbiental.php";
          document.forms.selecao.submit();
        }else if(acao == 'engeco'){
          document.forms.selecao.action="processaEngeco.php";
          document.forms.selecao.submit();
          }else if(acao == 'ambiental2'){
            document.forms.selecao.action="processaAmbientalSA.php";
            document.forms.selecao.submit();
            }else if(acao == 'novo'){
              document.forms.selecao.action="processaNovo.php";
              document.forms.selecao.submit();
            }
      }
    </script>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand">Conversor de arquivos</a>
      <a class="btn btn-primary" target="_blank" href="http://informatica.ambiental.sc/chamados/">Ajuda</a>
    </div>
  </nav>

  <!-- Masthead -->
  <!-- Enviar arquivo -->
  <section class="features-icons bg-light text-center">
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <!--<h4 class="mb-4">Selecionar Arquivo</h4>
          <p class="text-muted small mb-4 mb-lg-0"></p>-->
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <form action="javascript:void(0)" method="post" name="selecao" enctype="multipart/form-data">
            <div class="form-row">
              <!-- Escolher arquivo -->
              <div class="col-xl-9 mx-auto">
                <input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-outline-dark"><br>
              </div>
              <div class="col-12 text-center text-lg-center">
                <label for="exampleFormControlFile1">Envie apenas arquivos .csv</label><br><br>
              </div>
              <div class="col-12 text-center text-lg-center my-auto">
		<input class="col-xl-6 mx-auto btn btn-block btn-sm btn btn-success" type="submit" onclick="submitForm('novo');" value="Novo Ambiental"/>
                <input class="col-xl-6 mx-auto btn btn-block btn-sm btn btn-primary" type="submit" onclick="submitForm('ambiental');" value="Ambiental"/>
                <input class="col-xl-6 mx-auto btn btn-block btn-sm btn btn-primary" type="submit" onclick="submitForm('ambiental2');" value="Amb. Sobreaviso"/>
                <input class="col-xl-6 mx-auto btn btn-block btn-sm btn btn-primary" type="submit" onclick="submitForm('engeco');" value="Engeco"/>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center text-lg-center my-auto">
          <p class="text-muted small mb-4 mb-lg-0">&copy; Miraceli Bonjardim.</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
