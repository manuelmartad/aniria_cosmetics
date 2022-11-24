<?php
require_once '../../config/env.php';
require '../../config/db.php';


if ($_SESSION['login'] == false) {
  header('location:login.php');
}
if ($_SESSION['role'] != 'admin') {
  header('location: ../../index.php');
}


$sql = 'SELECT * FROM users';
$data = $conn->query($sql);


include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';
?>

<main id="main">


  <!-- ======= Skills Section ======= -->
  <section id="skills" class="skills section-bg">
    <div class="container">
      <div class="card p-3 border-0 shadow-lg">
        <div class="card-title">
          <span class="fs-4 ms-3">Administrar Usuarios</span>
        </div>
        <div class="card-body">
        <div class="animate__animated animate__fadeIn alert alert-danger text-center d-none w-50 mx-auto" id="response"><small></small></div>

          <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" id="usersTable">
              <thead style="background:linear-gradient(#020202, #464646);color:#fdfdfd">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Apellido</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Rol</th>
                  <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody id="reload">
                <?php if ($data->num_rows > 0) :

                  while ($row = $data->fetch_assoc()) :
                    $id = $row['id'];
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $uname = $row['username'];
                    $role = $row['role']; ?>
                    <tr class="align-middle">
                      <td><?php echo $id ?></td>
                      <td><?php echo $fname ?></td>
                      <td><?php echo $lname ?></td>
                      <td><?php echo $uname ?></td>
                      <td class="<?php echo $role == 'admin' ? 'text-danger fw-bold' : 'fw-bold' ?>"><?php echo $role ?></td>
                      <td class="d-flex justify-content-center gap-1">
                        <button class="btn btn-danger" id="delete__user" data-id="<?php echo $id; ?>"><i class="fa-solid fa-trash"></i></button>
                        <?php
                        $query = $conn->prepare("SELECT * FROM users WHERE blacklist = 'Y' AND username = ? and id = ?");
                        $query->bind_param('si', $uname, $id);
                        $query->execute();
                        $result = $query->get_result();
                        $result->fetch_assoc();

                        if ($result->num_rows === 1) { ?>
                          <button data-id="<?php echo $id; ?>" class="btn btn-success unblock"><i class="fa-solid fa-ban"></i></button>

                        <?php  } else { ?>
                          <button data-id="<?php echo $id; ?>" class="btn btn-primary blacklist"><i class="fa-solid fa-ban"></i></button>
                        <?php    }

                        ?>

                      </td>
                    </tr>
                <?php endwhile;
                endif;
                $conn->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>



    </div>
  </section><!-- End Skills Section -->

  <!-- ======= Portfolio Section ======= -->
  <!-- <section id="portfolio" class="portfolio section-bg">
      <div class="container">


        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery"
                  class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery"
                  class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery"
                  class="portfolio-lightbox" title="App 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery"
                  class="portfolio-lightbox" title="Card 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery"
                  class="portfolio-lightbox" title="Web 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery"
                  class="portfolio-lightbox" title="App 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery"
                  class="portfolio-lightbox" title="Card 1"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery"
                  class="portfolio-lightbox" title="Card 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery"
                  class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section> -->
  <!-- End Portfolio Section -->



</main><!-- End #main -->

<?php include '../../includes/templates/footer.php'; ?>