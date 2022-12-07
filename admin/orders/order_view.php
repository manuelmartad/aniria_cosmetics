<?php require_once '../../config/env.php';
require_once '../../config/db.php';


$sql = "SELECT a.*,b.* FROM orders a
JOIN sale_spot b ON a.spot_id = b.spot_id";
$orders = $conn->query($sql);


include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';
?>

<main id="main">
    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">

            <div class="card shadow-lg">

                <div class="card-body p-3 px-4">
                    <!-- <h5 class="py-3">Vista de Pedidos</h5> -->
                    <table class="table w-100 align-middle text-center" id="no-more-tables">
                        <thead>
                            <tr>

                                <th>Usuario</th>

                                <th>Punto de venta</th>
                                <th>Fecha</th>
                                <th>Artículos</th>
                                <th>Precio total</th>
                                <th> Más información</th>
                                <!-- <th>Estado</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($order = $orders->fetch_assoc()) : ?>
                                <tr>
                                    <td data-title="Usuario"><?php echo $order['name'] ?></td>

                                    <td data-title="Punto de Venta"><?php echo $order['sale_spot'] ?></td>
                                    <td data-title="Fecha"><?php echo $order['date'] ?></td>
                                    <td data-title="Artículos"><?php echo $order['totalItems'] ?></td>
                                    <td class="text-success fw-bold" data-title="Precio total"><span class="text-dark">$</span> <?php echo number_format($order['total'], 2) ?></td>
                                    <!-- <td><span class="badge bg-primary">En Proceso</span> -->
                                    <!-- </td>
                                    <td><button type="button" class="btn btn-primary py-1" data-bs-toggle="modal" data-bs-target="#modalId"><i class="fa-solid fa-magnifying-glass pe-1"></i>Visualizar</td> -->
                                    <td data-title="Más información">
                                        <div class="btn-group">
                                            <button class="btn btn-danger btn-sm moreinfo" data-id="<?php echo $order['transaction_id'] ?>" type="button" data-bs-toggle="modal" data-bs-target="#modalId">
                                                Ver </button>


                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>



                            <!-- Modal Body -->
                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                            <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-sm animate__animated animate__fadeInDown animate__faster" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">Más información</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="info"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>



                        </tbody>
                    </table>

                </div>
            </div>



        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Portfolio Section ======= -->

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" style="margin-left:150px ;" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content px-3 pt-2">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">INFORMACION DE LA COMPRA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- AQUI IRA LA INFORMACION CON LA ORDEN DE COMPRA
                    ---CUANDO SE PRESIONE EL BOTON VISUALIZAR ENVIARA PETICION AJAX PARA CAMBIAR EL ESTATUS DE LA NOTIFICACION EN
                    LA BASE DE DATOS 1 - SEEN 0 -UNSEEN -->
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo ASSETS ?>img/portfolio/portfolio-details-1.jpg" alt="" width="150" height="150">
                        </div>
                        <div class="col-md-9">
                            <span class="fs-5">Producto Prueba</span>
                            <p class="text-muted">2 x $500</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo ASSETS ?>img/portfolio/portfolio-details-2.jpg" alt="" width="150" height="150">
                        </div>
                        <div class="col-md-9">
                            <span class="fs-5">Producto Prueba</span>
                            <p class="text-muted">2 x $500</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">Aprobar</button>

                </div>
            </div>
        </div>
    </div>


</main><!-- End #main -->

<?php include '../../includes/templates/footer.php'; ?>