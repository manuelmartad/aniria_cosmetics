<?php
require '../config/db.php';
require_once '../config/env.php';
include '../config/funciones.php';

if (isset($_SESSION['login'])) {
    header('location:index.php');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // $username = $conn->real_escape_string(sanitizeData($_POST['username']));
    // $password = $conn->real_escape_string(sanitizeData($_POST['password']));

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
                $error = "Hay un error con tu contraseña";
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


        <div class="card p-2 shadow-lg border-0 col-lg-7 col-md-10 mx-auto mt-0" id="login-card">

            <?php if (isset($_GET["success"]) == 1) : ?>
                <div class="alert alert-success text-center">
                    <small>¡Usuario creado con éxito!</small>
                </div>

            <?php endif; ?>
            <div class="card-title text-center pt-3">
                <!-- <img src="<?php echo ASSETS ?>img/aniria.jpg" class="img-fluid" alt="aniria-logo"> -->
                <h3>Aniria</h3>
            </div>
            <div class="card-body p-3">
                <small class="mb-3">Por favor, introduzca su dirección de correo electrónico. Se le enviará una contraseña temporal por parte de un administrador. Una vez que haya recibido su contraseña temporal, podrá elegir una nueva contraseña para su cuenta.</small>
                <form method="post" class="needs-validation mt-3" novalidate>

                    <div class="mb-3">
                        <input type="email" class="form-control" id="floatingInput" required placeholder="name@example.com">
                        <small class="invalid-feedback">El correo es necesario</small>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-50">Recuperar contraseña</button>
                    </div>
            </div>
            </form>
            <div class="text-center">
                <a href="login.php" class="btn btn-link"><small>Volver a inicio</small></a>
            </div>

        </div>
    </div>



    </div>
</section><!-- End Skills Section -->
<?php include '../includes/templates/footer.php'; ?>