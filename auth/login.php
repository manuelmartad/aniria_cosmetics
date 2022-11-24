<?php
require '../config/db.php';
require_once '../config/env.php';
include '../config/funciones.php';

if (isset($_SESSION['login'])) {
    header('location:index.php');
}
$error = "";
$username = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $conn->real_escape_string(sanitizeData($_POST['username']));
    $password = $conn->real_escape_string(sanitizeData($_POST['password']));

    if (!$username || !$password) {
        $error = "Hay un error en los campos.";
    }

    if (empty($errors)) {
        // verificar que el usuario exista
        $sql = $conn->prepare("SELECT * FROM users WHERE username = ? AND blacklist = 'N'");
        $sql->bind_param("s", $username);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            // verificar que el password sea correcto.
            $row = $result->fetch_assoc();
            $pass = password_verify($password, $row['password']);

            if ($pass == $password) {

                $_SESSION['login'] = true;
                $_SESSION['role'] = $row['role'];
                $_SESSION['name'] = $row['fname'];
                $_SESSION['lastname'] = $row['lname'];
                $_SESSION['id'] = $row['id'];

                if ($_SESSION['role'] === 'admin') {
                    header('location:../admin/dashboard/dashboard.php');
                }

                if ($_SESSION['role'] === 'user') {
                    header('location:../index.php');
                }
            } else {
                $error = "hay un error con tu contraseña";
            }
        } else {
            $error = "Hay un error con tu cuenta";
        }



        $sql->close();
        $conn->close();
    }

    $_SESSION['message'] =  $error;
    $mensaje = '<div class="alert alert-danger text-center"><i class="fa-solid fa-triangle-exclamation pe-2"></i>' . $error . '</div>';

}

include '../includes/templates/header.php';

?>

<!-- ======= Skills Section ======= -->
<section id="skills" class="skills vh-100 pt-3 pt-xxl-5" style=" background: linear-gradient(#fdfbfd, #ffacb3, #4b4b4b );">
    <div class="container">


        <div class="card p-2 shadow-lg border-0 col-md-5 mx-auto mt-0">


            <div class="card-title">
                <img src="<?php echo ASSETS ?>img/aniria.jpg" class="img-fluid" alt="aniria-logo">
            </div>
            <div class="card-body p-3">
                <form method="post" class="needs-validation" novalidate>

                    <div class="mb-3">
                        <!-- <label for="" class="form-label">Usuario</label> -->
                        <input type="text" class="form-control" name="username" id="username" required placeholder="Usuario" value="<?= $username ?>">
                    </div>

                    <div class="mb-3">
                        <!-- <label for="" class="form-label">Password</label> -->
                        <input type="password" class="form-control" name="password" id="password" required placeholder="Password">
                    </div>
                    <?php echo isset($mensaje) ? $mensaje : '';
                    unset($mensaje) ?>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100">Iniciar</button>
                    </div>
                </form>
                <div class="d-flex align-items-center mt-2 justify-content-center">
                    <span>No tienes cuenta?</span><a href="register.php" class="btn btn-link">Registrate</a>
                </div>

            </div>
        </div>



    </div>
</section><!-- End Skills Section -->
<?php include '../includes/templates/footer.php'; ?>