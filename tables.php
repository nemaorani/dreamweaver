
<?php
include 'all_process.php';

if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit_state = true;
        
        $record = mysqli_query($conn, "SELECT * FROM data WHERE id=$id");
$data = mysqli_fetch_array($record);
            $name = $data['name'];
            $address = $data['address'];
            $mobile_number = $data['mobile_number'];

        
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dreamweaver Farm Inc</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Dreamweaver Inc</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
               <!--  <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> -->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                          
                            </a>
                            
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                               
                            </div>
                           <!--  <div class="sb-sidenav-menu-heading">Addons</div> -->
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Crops
                            </a>
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Animals
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Control Panel
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Kobus
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Manage Livestock</h1>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol> -->
                        <div class="card mb-4">
                            <!-- <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div> -->
                        </div>
                        <?php if (isset($_SESSION['message'])):?>
                        <div class="message">
                        <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']); 
                        ?>
                         </div>
                         <?php endif ?>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Add New Livestock
                            </div>
                            <br>

                        <form class="form-inline" method="POST" action="all_process.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="text" name="name" placeholder="Animal Type" value="<?php echo $name; ?>">
        <input type="text" name="address" placeholder="Age" value="<?php echo $address; ?>">
        <input type="text" name="mobile_number" placeholder="Health Status" value="<?php echo $mobile_number; ?>">
    <?php if ($edit_state == false): ?>
    <button class="btn" type="submit" name="save" >Save</button>
<?php else: ?>
    <button class="btn" type="submit" name="update" >Update</button>
<?php endif ?>
        
     </form>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Animal Type</th>
                                            <th>Age</th>
                                            <th>Health Status</th>
                                            <th>Action</th>
                                          <!--  <th>Delete</th> -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Animal Type</th>
                                            <th>Age</th>
                                            <th>Health Status</th>
                                            <th>Action</th>
                                          <!--  <th>Delete</th> -->
                                        </tr>
                                    </tfoot>
                                 

                                    <?php
    $result = mysqli_query($conn, "SELECT * FROM data");
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {

    ?>
    <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row["name"]; ?></td>
    <td><?php echo $row["address"]; ?></td>
    <td><?php echo $row["mobile_number"]; ?></td>
    <td><a href="tables.php?edit=<?php echo $row["id"]; ?>" class="edit_btn">Edit</a></td>
    <td><a href="all_process.php?delete=<?php echo $row["id"]; ?>" class="del_btn">Delete</a></td>
    </tr>
    <?php
    $i++;
}
    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
