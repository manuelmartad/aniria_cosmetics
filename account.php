<?php
require 'config/env.php';
require 'config/db.php';


$user = $conn->query("SELECT a.* FROM users a WHERE a.id = {$_SESSION["id"]}");
$user_data = $user->fetch_assoc();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['userid'];
    $image = $_FILES['imagen'];

    if (!$image['name']) {
        $error = "La imagen no puede estar vacia.";
    }

    if (empty($error)) {

        $upload = 'admin/users/uploads/';

        if (!is_dir($upload)) {
            mkdir($upload);
        }
        $image_name = "";
        if ($image) {
            unlink($upload . $user_data['image']);

            // generar nombre unico
            $image_name = md5(uniqid(rand(), true)) . ".jpg";

            move_uploaded_file($_FILES['imagen']['tmp_name'], $upload . $image_name);
        } else {
            $image_name = $user_data['image'];
        }



        $conn->query("UPDATE users SET image = '$image_name' WHERE id =  '$id'");

        header("location:account.php");
    }
}




print_r($user_data);


include 'includes/templates/indexHeader.php';
?>
<div class="container">
    <div class="border">
        <div class="row p-3 align-items-center gap-3">
            <div class="col-md-3 text-lg-end pt-3">
                <img src="admin/users/uploads/<?php echo $user_data['image'] ?>" alt="" class="rounded-circle" height="170" width="170">
                <a type="button" data-bs-toggle="modal" data-bs-target="#modalId" class="d-block mt-3 pe-4">Cambiar imagen</a>
            </div>
            <div class="col-md-7">
                <div class="d-flex gap-2">
                    <p class="fw-bold">Nombre:</p>
                    <span><?php echo $user_data['fname'] . ' ' . $user_data['lname']  ?></span>
                </div>

                <div class="d-flex gap-2">
                    <p class="fw-bold">Usuario:</p>
                    <span><?php echo $user_data['username']  ?></span>
                </div>
                <div class="d-flex gap-2">
                    <p class="fw-bold">Rol:</p>
                    <span><?php echo $user_data['role']  ?></span>
                </div>

                <div class="d-flex gap-2">
                    <p class="fw-bold">Teléfono</p>
                    <span><?php echo $user_data['phone']  ?></span>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Subir foto de perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-4 mt-3">
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?>">
                        <input type="file" name="imagen" id="imagen" class="form-control">
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary px-4">Subir</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>





<?php include 'includes/templates/indexFooter.php';
?>