<?php
require_once 'vendor/autoload.php';
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
$connectionString = "DefaultEndpointsProtocol=https;AccountName=ekosantosowebapp;AccountKey=Tt+XjBprU+zV13JBKpv8753g7lNYaBGtodGifCKBjWliHuSQ4gxroa+kAPOZEXgVrKkkX2X0SNH4yi2atyUD3A==";
$blobClient = BlobRestProxy::createBlobService($connectionString);
$containerName = "patrickblob";
  
if (isset($_POST['submit'])) {
  $fileToUpload = $_FILES["fileToUpload"]["name"];
  $content = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
  echo fread($content, filesize($fileToUpload));
    
  $blobClient->createBlockBlob($containerName, $fileToUpload, $content);
  header("Location: index2.php");
} 
  
$listBlobsOptions = new ListBlobsOptions();
$listBlobsOptions->setPrefix("");
$result = $blobClient->listBlobs($containerName, $listBlobsOptions);
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/eeac6afcab.js" crossorigin="anonymous"></script>

    <title>Submission 2</title>
  </head>
  <body style="background-color: #F6F5F5">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-white" href="index.php">Submission 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="index2.php">Submission 2</a>
          </li>
        </ul>
      </div>
      </div>
    </nav>
    

  <div class="container">

    <div class="row mt-3">
      <div class="col-md-5">
              <div class="form-group">
                <label for="exampleFormControlFile1">Upload Picture</label>
                <form action="index2.php" method="post" enctype="multipart/form-data">
                <input type="file" class="form-control-file" name="fileToUpload" accept=".jpeg,.jpg,.png" required="">
                <button type="submit" class="btn btn-primary mt-2" name="submit"><i class="fas fa-cloud-upload-alt"></i> Upload</button>
                </form>
              </div>
      </div>
    </div>

    <table class="table table-bordered">
      <thead class="thead thead-dark">
        <th>No</th>
        <th>Image</th>
        <th>Url</th>
        <th>Action</th>
      </thead>
      <?php $i = 1; ?>
      <tbody>
        <?php
      do {
        foreach ($result->getBlobs() as $blob) {
       ?>
        <tr>
          <td><?php echo $i++; ?></td>
          <td><?php echo $blob->getName() ?></td>
          <td><?php echo $blob->getUrl() ?></td>
          <td>
            <form action="process.php" method="post">
                  <input type="hidden" name="url" value="<?php echo $blob->getUrl()?>">           
                  <input class="btn btn-primary" type="submit" name="submit" value="Lihat">
            </form>
          </td>
        </tr>
        <?php
              } $listBlobsOptions->setContinuationToken($result->getContinuationToken());
            } while($result->getContinuationToken());
            ?>
      </tbody>
    </table>

  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>