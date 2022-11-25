  <!-- ======= Footer ======= -->
  <footer id="footer">
      <div class="container">

      </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <!-- <script src="//vendor/purecounter/purecounter_vanilla.js"></script> -->
  <!-- <script src="/vendor/aos/aos.js"></script> -->
  <script src="<?php echo ASSETS ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo ASSETS ?>vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?php echo ASSETS ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo ASSETS ?>vendor/swiper/swiper-bundle.min.js"></script>
  <!-- <script src="//vendor/typed.js/typed.min.js"></script>
  <script src="//vendor/waypoints/noframework.waypoints.js"></script>
  <script src="//vendor/php-email-form/validate.js"></script> -->

  <!-- Template Main JS File -->
  <script src="<?php echo JS ?>main.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
  <script src="<?php echo ASSETS ?>vendor/jquery/jquery.js"></script>
  <script src="<?php echo ASSETS ?>vendor/sweetalert/sweetalert2.min.js"></script>
  <script src="<?php echo JS ?>scripts.js"></script>
  <script type="text/javascript" src="<?php echo ASSETS ?>vendor/datatables/datatables.min.js"></script>





  <script>
      $(document).ready(function() {


          $('.animate').hover(function() {
              $(this).addClass('animate__animated animate__heartBeat');

          }, function() {
              $(this).removeClass('animate__animated animate__heartBeat');
          });

          $('li').hover(function() {
              $(this).addClass('animate__animated animate__pulse animate__faster');

          }, function() {
              $(this).removeClass('animate__animated animate__pulse animate__faster');
          });

          $(document).on('click', '.unblock', (function(e) {

              Swal.fire({
                  title: '¿Estás seguro?',
                  icon: 'warning',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Desbloquear',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      var unblock = $(this).attr('data-id');
                      $.ajax({
                          type: "post",
                          url: "../users/blacklist.php",
                          data: {
                              unblock: unblock
                          },
                          success: function(response) {
                              $('#response').removeClass('d-none')
                              $('#response').html(response)
                              $("#reload").load(location.href + " #reload>*");
                              setTimeout(() => {
                                  $('#response').addClass('d-none');
                              }, 3000);
                          }
                      });
                  }
              })

          }))

          $(document).on('click', '.blacklist', (function(e) {
              Swal.fire({
                  title: '¿Estás seguro?',
                  icon: 'warning',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Bloquear',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      var block = $(this).attr('data-id');
                      $.ajax({
                          type: "post",
                          url: "../users/blacklist.php",
                          data: {
                              block: block
                          },
                          success: function(response) {
                              $('#response').removeClass('d-none')
                              $('#response').html(response)
                              $("#reload").load(location.href + " #reload>*");
                              setTimeout(() => {
                                  $('#response').addClass('d-none');
                              }, 3000);
                          }
                      });
                  }
              })

          }))

          $(document).on('click', '#delete__user', (function() {

              Swal.fire({
                  title: '¿Estás seguro?',
                  icon: 'warning',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Eliminar',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      var user = $(this).attr('data-id');
                      $.ajax({
                          type: "post",
                          url: "blacklist.php",
                          data: {
                              user: user
                          },
                          success: function(response) {
                              $('#response').removeClass('d-none')
                              $('#response').html(response);
                              $("#reload").load(location.href + " #reload>*");
                              setTimeout(() => {
                                  $('#response').addClass('d-none');
                              }, 3000);
                          }
                      });
                  }
              })

          }))


          $(document).on('click', '.deleteProduct', (function() {

              Swal.fire({
                  title: '¿Estás seguro?',
                  icon: 'warning',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Eliminar',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      var product = $(this).attr('data-id');
                      $.ajax({
                          type: "post",
                          url: "../../response.php",
                          data: {
                              id: product
                          },
                          success: function(response) {
                              $("#no-more-tables").load(location.href + " #no-more-tables>*");
                              Swal.fire(
                                  'Eliminado!',
                                  'El producto ha sido eliminado.',
                                  'success'
                              )
                              setTimeout(() => {

                              }, 2000);

                          }
                      });
                  }
              })

          }))
          //   var 
          //   frm = $("#addProduct").submit(function(e) {
          //       e.preventDefault();
          //       var formData = new FormData(this);

          //       $.ajax({
          //           async: true,
          //           type: frm.attr('method'),
          //           url: frm.attr('action'),
          //           data: formData,
          //           cache: false,
          //           processData: false,
          //           contentType: false,
          //           dataType: "json",

          //           success: function(data) {
          //               console.log(data.message)
          //               $("#response").html(data.message);
          //           },
          //           error: function(request, status, error) {
          //               console.log("error")
          //           }
          //       });

          //   });


      });
  </script>

  </body>

  </html>