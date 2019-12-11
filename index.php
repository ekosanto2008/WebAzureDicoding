<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/eeac6afcab.js" crossorigin="anonymous"></script>

    <title>Submission 1</title>
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
            <a class="nav-link text-white" href="#">Submission 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="index2.php">Submission 2</a>
          </li>
        </ul>
      </div>
      </div>
    </nav>

    <div class="container">
        <div class="row mt-4">
            <div class="col">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-square"></i> Add</button>
            </div>
        </div>
    </div>


    
          <?php
        // PHP Data Objects(PDO) Sample Code:
        try {
            $conn = new PDO("sqlsrv:server = tcp:ekosantosoapp.database.windows.net,1433; Database = dicoding_azure", "ekosantoso", "D0r4emon");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            print("Error connecting to SQL Server.");
            die(print_r($e));
        }
        if (isset($_POST['submit'])) {
            try {
                $id = $_POST['id'];
                $name = $_POST['user_name'];
                $email = $_POST['email'];
                $job = $_POST['job'];
                $conn->exec("INSERT INTO [dbo].[user_dicoding] (id, user_name, email, job) VALUES ('$id','$name','$email','$job')");
            } catch(Exception $e) {
                echo "Failed: " . $e;
            }
            echo "<div class='container'>";
            echo "<div class='row mt-3'>";
            echo "<div class='col-md-5'>";
            echo "<h6 class='alert alert-success'>Success Added Data</h6>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } 
            try {
                $sql_select = "SELECT * FROM [dbo].[user_dicoding]";
                $stmt = $conn->query($sql_select);
                $registrants = $stmt->fetchAll(); 
                $i = 1;
                if(count($registrants) > 0) {
                    echo "<div class='container'>";
                    echo "<div class='row mt-2'>";
                    echo "<div class='col-md-7'>";
                    echo "<table class='table table-bordered'>";
                    echo "<thead class='thead thead-dark'>";
                    echo "<th>No</th>";
                    echo "<th>Name</th>";
                    echo "<th>Email</th>";
                    echo "<th>Job</th>";
                    echo "</thead>";
                    foreach($registrants as $registrant) {

                        echo "<tr><td>".$i++."</td>";
                        echo "<td>".$registrant['user_name']."";
                        echo "<td>".$registrant['email']."</td>";
                        echo "<td>".$registrant['job']."</td>";
                    }
                    echo "</table>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<h3>No one is currently registered.</h3>";
                }
            } catch(Exception $e) {
                echo "Failed: " . $e;
            }
        
    ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="index.php">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="id" name="id">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="user_name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Email" name="email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Job" name="job">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Add</button>
          </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>