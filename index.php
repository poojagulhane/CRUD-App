<?php
$insert = false;
$update = false;
$delete = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";
$con = mysqli_connect($servername, $username, $password, $database);
if (isset($_GET['delete'])) {
    $Sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `notes` WHERE `notes`.`Sno` = $Sno";
    $result = mysqli_query($con, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoedit'])) {
        //update the record
        $Sno = $_POST['snoedit'];
        $title = $_POST['titleedit'];
        $description = $_POST['descriptionedit'];
        $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`Sno` = $Sno";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $update = true;
        } else {
            echo "failed";
        }
    } else {
        $title = $_POST['title'];
        $description = $_POST['description'];


        // Submit these to a database

        if (!$con) {
            die("sorry");
        } else {



            $sql = "INSERT INTO `notes` (`Sno`, `title`, `description`, `datetime`) VALUES (NULL, '$title', '$description', current_timestamp())";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $insert = true;
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>error!</strong> We are facing technical issue and Your entry not has been submitted successfully!
        We regret for your inconvince
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>';
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Button trigger modal -->
    <!-- Latest compiled and minified CSS -->


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Get and post!</title>
</head>

<body>

    <!-- Button trigger modal -->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="index.php" method="post">
                    <div class="modal-body">

                        <input type="hidden" name="snoedit" id="snoedit">
                        <div class="form-group">
                            <label for="title">Note Title</label> <input type="text" class="form-control" id="titleedit" name="titleedit">
                        </div>
                        <div class="form-group">
                            <label for="description">Note Description</label> <textarea type="text" class="form-control" id="descriptionedit" cols="5" rows="4" name="descriptionedit"> </textarea>
                        </div>


                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <nav class=" navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">INotes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/cwhphp/21_Get_Post.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
   
    
    <?php
    if ($update) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your entry has been Updated successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>';
      
    }

    ?>
    <?php 
    if($insert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your entry has been submitted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>';
     
    }
    ?>
    <?php
    if ($delete) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your entry has been deleted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>';
      
    }
    ?>
    <div class="container my-4">
        <h1>Add a Notes to INotes</h1>
        <form action="index.php" method="post">
            <div class="mb-3">
                <label for="title">Note Title</label> <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="description">Note Description</label> <textarea type="text" class="form-control" id="description" cols="5" rows="4" name="description"> </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note </button>
        </form>
    </div>


    <div class="container my-4">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No </th>
                    <th scope="col"> Title </th>
                    <th scope="col"> Description </th>
                    <th scope="col"> Action </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($con, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo  "<tr> <th>" . $sno . "</th>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                   <td> <button class='edit btn btn-sm btn-primary' id=" . $row['Sno'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=d" . $row['Sno'] . ">Delete</button>  </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <hr>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        edits = document.getElementsByClassName('edit')
        Array.from(edits).forEach(element => {
            element.addEventListener("click", (e) => {
                console.log("edit", );
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                titleedit.value = title;
                descriptionedit.value = description;
                snoedit.value = e.target.id;
                console.log(e.target.id);
                $('#exampleModal').modal('toggle');
            })
        });
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                sno = e.target.id.substr(1);

                if (confirm("Are you sure you want to delete this note!")) {
                    console.log("yes");
                    window.location = `/CrudApp/index.php?delete=${sno}`;
                    // TODO: Create a form and use post request to submit a form
                } else {
                    console.log("no");
                }
            })
        })
    </script>

    <footer>
        <center>
            <p>Copyright &copy;. INotes All Rights Reserved | Contact Us: +91 90000 00000 || Pooja Gulhane</p>
        </center>
    </footer>
</body>

</html>