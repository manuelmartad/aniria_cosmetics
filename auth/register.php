<?php
include '../config/funciones.php';
require_once '../config/db.php';
require_once '../config/env.php';
include '../includes/templates/header.php';

if (isset($_SESSION['login'])) {
    header('location:index.php');
} else {
    // Agregar index para usuarios si no es admin
}

$fname = "";
$lname = "";
$username = "";
$phone = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $fname = $conn->real_escape_string(sanitizeData($_POST['fname']));
    $lname = $conn->real_escape_string(sanitizeData($_POST['lname']));
    $username = $conn->real_escape_string(sanitizeData($_POST['username']));
    $password = $conn->real_escape_string(sanitizeData($_POST['password']));
    $password_two = $conn->real_escape_string(sanitizeData($_POST['password_two']));
    $phone = $conn->real_escape_string(sanitizeData($_POST['phone']));

    if (empty($fname) || empty($lname) || empty($password) || empty($username) || empty($phone)) {
        alertMessage("danger", "Hay un error en los campos.");
    }
    // password validation
    if (strlen($password) <= 6) {
        alertMessage("danger", "El password debe ser mayor a 6 caracteres!");
    }

    if ($password !== $password_two) {
        alertMessage("danger", "El password no coincide");
    } else {

        $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
    }
    // ends password validation
    if (strlen($phone) != 10) {
        alertMessage("danger", "El telefono debe ser de 10 digitos!");
    }
    if (!preg_match("/^[0-9]+$/", $phone)) {
        alertMessage("danger", "Ingresa un numero de telefono valido!");
    }
    if (empty($errors)) {

        $sql = "SELECT username FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            alertMessage("danger", 'Este usuario ya existe.');
        } else {
            $sql = $conn->prepare("INSERT INTO users(fname,lname,username,password,phone) 
            VALUES(?,?,?,?,?)");
            $sql->bind_param("ssssi", $fname, $lname, $username, $hashed_pass, $phone);

            if ($sql->execute()) {
                alertMessage("success", "Usuario creado con exito!");
            }
            $sql->close();
            $conn->close();
        }
    }
}

?>

<!-- ======= Skills Section ======= -->
<section id="skills" class="skills vh-100 pt-2 pt-xxl-5" style="  background: linear-gradient(#fdfbfd, #ffacb3, #4b4b4b );">
    <div class="container">
        <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
        unset($_SESSION['message']) ?>
        <div class="card mb-3 p-2 shadow-lg border-0 mx-auto mt-0 col-lg-8 col-md-12" id="login-card">
            <div class="row g-0">
                <div class="col-md-6 d-none d-md-block">
                    <img src="<?php echo ASSETS ?>img/aniria.jpg" class="img-fluid pt-5" alt="aniria-logo">
                </div>
                <div class="col-md-6">
                    <div class="card-body p-3">
                        <form action="" method="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <!-- <label for="" class="form-label">Nombre</label> -->
                                <input type="text" class="form-control" name="fname" id="" placeholder="Nombre" required value="<?= $fname ?>">
                                <small class="invalid-feedback">Este campo es obligatorio</small>

                            </div>
                            <div class="mb-3">
                                <!-- <label for="" class="form-label">Apellido</label> -->
                                <input type="text" class="form-control" name="lname" id="" placeholder="Apellido" required value="<?= $lname ?>">
                                <small class="invalid-feedback">Este campo es obligatorio</small>

                            </div>

                            <div class="mb-3">
                                <!-- <label for="" class="form-label">Username</label> -->
                                <input type="text" class="form-control" name="username" id="" placeholder="Username" required value="<?= $username ?>">
                                <small class="invalid-feedback">Este campo es obligatorio</small>

                            </div>

                            <div class="mb-3">
                                <!-- <label for="" class="form-label">Telefono</label> -->
                                <input type="text" class="form-control" name="phone" id="" placeholder="Teléfono" required value="<?= $phone ?>">
                                <small class="invalid-feedback">Este campo es obligatorio</small>

                            </div>

                            <div class="mb-3">
                                <!-- <label for="" class="form-label">Password</label> -->
                                <input type="text" class="form-control" name="password" id="" placeholder="Contraseña" required value="<?= $password ?>">
                                <small class="invalid-feedback">Este campo es obligatorio</small>

                            </div>

                            <div class="mb-3">
                                <!-- <label for="" class="form-label">Repite Password</label> -->
                                <input type="text" class="form-control" name="password_two" id="" placeholder="Repite tu Contraseña" required>
                                <small class="invalid-feedback">Este campo es obligatorio</small>

                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-100">Registarse</button>
                            </div>
                        </form>
                        <div class="row align-items-center text-center mt-3">
                            <span class="col-md-6">¿Ya tienes una cuenta?</span><a href="login.php" class="btn btn-link col-md-6">Iniciar sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Skills Section -->

<?php include '../includes/templates/footer.php'; ?>