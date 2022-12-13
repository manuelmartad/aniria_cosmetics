  <!-- ======= Footer ======= -->
  <footer id="footer">
      <div class="container">

      </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <!-- <script src="/vendor/aos/aos.js"></script> -->
  <script src="<?php echo ASSETS ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo ASSETS ?>vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?php echo ASSETS ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo ASSETS ?>vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo JS ?>main.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
  <script src="<?php echo ASSETS ?>vendor/jquery/jquery.js"></script>
  <script src="<?php echo ASSETS ?>vendor/sweetalert/sweetalert2.min.js"></script>
  <script src="<?php echo JS ?>scripts.js"></script>




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

          $(".card-animated").hover(function(e) {
              e.stopPropagation()
              $(this).addClass('animate__animated animate__pulse animate__faster');



          }, function() {
              $(this).removeClass('animate__pulse')
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
                              $("#reload").load(location.href + " #reload>*");
                              Swal.fire(
                                  'Exito!',
                                  'El usuario ha sido desbloqueado.',
                                  'success'
                              )
                          }
                      });
                  }
              })

          }))

          $(document).on('click', '.blacklist', (function(e) {
              Swal.fire({
                  title: '¿Estás seguro?',
                  icon: 'warning',
                  text: 'Este usuario no podrá iniciar sesión ',
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
                              $("#reload").load(location.href + " #reload>*");
                              Swal.fire(
                                  'Exito!',
                                  'El usuario ha sido bloqueado.',
                                  'success'
                              )
                          }
                      });
                  }
              })

          }))

          $(document).on('click', '.deleteUser', (function() {

              Swal.fire({
                  title: '¿Estás seguro?',
                  icon: 'warning',
                  text: 'Este usuario no podrá iniciar sesión más',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Eliminar',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      var id = $(this).attr('data-id');
                      $.ajax({
                          type: "post",
                          url: "blacklist.php",
                          data: {
                              id: id
                          },
                          success: function(response) {
                              $("#reload").load(location.href + " #reload>*");
                              Swal.fire(
                                  'Exito!',
                                  'El usuario ha sido eliminado.',
                                  'success'
                              )
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
                              );
                          }
                      });
                  }
              })

          }))

          $(document).on('click', '.deleteSpot', (function() {

              Swal.fire({
                  title: '¿Estás seguro?',
                  icon: 'warning',
                  text: 'Este punto de venta será eliminado',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Eliminar',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      var spot = $(this).attr('data-id');
                      $.ajax({
                          type: "post",
                          url: "../../response.php",
                          data: {
                              spotid: spot
                          },
                          success: function(response) {
                              $("#portfolio").load(location.href + " #portfolio>*");
                              Swal.fire(
                                  'Eliminado!',
                                  'El punto de venta ha sido eliminado.',
                                  'success'
                              );
                          }
                      });
                  }
              })

          }));

          $(document).on('click', '.deleteCategory', (function() {

              Swal.fire({
                  title: '¿Estás seguro?',
                  icon: 'warning',
                  text: 'Esta categoria será eliminada',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Eliminar',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      var category = $(this).attr('data-id');
                      $.ajax({
                          type: "post",
                          url: "../../response.php",
                          data: {
                              category: category
                          },
                          success: function(response) {
                              $("#no-more-tables").load(location.href + " #no-more-tables>*");
                              Swal.fire(
                                  'Eliminado!',
                                  'La categoria ha sido eliminada.',
                                  'success'
                              );
                          }
                      });
                  }
              })

          }));

          $(document).on('click', '.deleteStock', (function() {

              Swal.fire({
                  title: '¿Estás seguro?',
                  icon: 'warning',
                  text: 'Este producto será eliminado del inventario',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Eliminar',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      var stock = $(this).attr('data-id');
                      $.ajax({
                          type: "post",
                          url: "../../response.php",
                          data: {
                              stock: stock
                          },
                          success: function(response) {
                              $("#no-more-tables").load(location.href + " #no-more-tables>*");
                              Swal.fire(
                                  'Eliminado!',
                                  'El producto ha sido eliminado.',
                                  'success'
                              );
                          }
                      });
                  }
              })

          }))


          $(document).on('click', '.makemeadmin', (function() {

              Swal.fire({
                  title: '¿Estás seguro?',
                  icon: 'warning',
                  text: '¿Quieres hacer a este usuario administrador?',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      var user = $(this).attr('data-id');
                      $.ajax({
                          type: "post",
                          url: "../../response.php",
                          data: {
                              admin: user
                          },
                          success: function(response) {
                              $("#no-more-tables").load(location.href + " #no-more-tables>*");
                              Swal.fire(
                                  'Exito!',
                                  'El usuario ahora tiene privilegios de administrador.',
                                  'success'
                              )
                              //   toastr.info('Are you the 6 fingered man?')
                          }
                      });
                  }
              })

          }));

          $(document).on('click', '.makemenormaluser', (function() {

              Swal.fire({
                  title: '¿Estás seguro?',
                  icon: 'warning',
                  text: '¿Deseas eliminar privilegios de administrador a este usuario?',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      var noadmin = $(this).attr('data-id');
                      $.ajax({
                          type: "post",
                          url: "../../response.php",
                          data: {
                              noadmin: noadmin
                          },
                          success: function(response) {
                              $("#no-more-tables").load(location.href + " #no-more-tables>*");

                          }
                      });
                  }
              })

          }));

          $(document).on('click', '.dismissnotification', function() {
              var dismiss = $(this).attr('data-id')
              $.ajax({
                  type: "post",
                  url: "../../response.php",
                  data: {
                      dismiss: dismiss
                  },
                  success: function(response) {
                      $("#skills").load(location.href + " #skills>*");
                      $("#navbar").load(location.href + " #navbar>*");
                  }
              });
          })


          $('#addnewstock').click(function() {

              var qty = $('#qty').val()
              var product = $('#product').val()
              var salespot = $('#salespot').val()


              if (qty == 0 || product == null || salespot == null) {
                  $(".validateinput").removeClass("d-none");
                  $(".validateinput").text("Por favor, rellene todos los campos*");
                  $('#product').css('border-color', 'red');
                  $('#salespot').css('border-color', 'red');
                  $('#qty').css('border-color', 'red');

                  return false;

              } else {


                  $("#addstocktoproduct").submit(function(e) {
                      e.preventDefault()
                      $.ajax({
                          type: "post",
                          url: "add_stock.php",
                          data: {
                              qty: qty,
                              product: product,
                              salespot: salespot
                          },
                          success: function(response) {
                              $("#no-more-tables").load(location.href + " #no-more-tables>*");
                              Swal.fire(
                                  'Exito!',
                                  'Stock agregado al producto.',
                                  'success'
                              )

                              //   toastr["success"]("Nuevo stock agregado")                              //   location.href = "view_stock.php?added-stock=1"
                              $("#addstocktoproduct")[0].reset()
                              //   $("#modalId")[0].reset()
                              $(".validateinput").addClass("d-none");
                              $('#product').css('border-color', '#ced4da');
                              $('#salespot').css('border-color', '#ced4da');
                              $('#qty').css('border-color', '#ced4da');

                              $("#modalId").modal("hide")

                          }
                      });


                  })

              }



          })

      });
  </script>


 
  </body>

  </html>