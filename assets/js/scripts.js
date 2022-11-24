$(function () {

    // GLOBALS
    $(".navbar-toggler").click(function () {
        $('i.fa-bars').toggleClass('animate__animated animate__bounceIn')
    });


    // ADMIN
    $("#signout").click(function () {

        Swal.fire({
            title: '¿Estás seguro?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, cerrar sesión!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: '../../auth/logout.php',
                    success: function (response) {
                        location.href = "../../auth/login.php";
                    }
                });
            }
        })
    })

    // INDEX
    $("#logout").click(function () {

        Swal.fire({
            title: '¿Estás seguro?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, cerrar sesión!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: 'auth/logout.php',
                    success: function (response) {
                        location.href = "auth/login.php";
                    }
                });
            }
        })
    })

    $(document).on('click', '.like', function (e) {
        e.stopPropagation()
        var id = $(this).attr("data-id")
        $.ajax({
            type: "POST",
            url: "response.php",
            data: {
                productId: id
            },
            success: function (response) {
                $('.like').parent().html(`<a type="button" class="like"><i class="fa-solid fa-heart text-danger"></i></a>`)
                console.log(response)
            }
        });
    })

    $(document).on('submit', '#form_cart', function (e) {
        e.preventDefault()
        $.ajax({
            type: "post",
            url: "cart_process.php",
            data: $(this).serialize(),
            success: function (response) {
                Swal.fire(
                    'Agregado!',
                    'El producto ha sido agregado al carrito.',
                    'success'
                )
                $('.product-modal').modal('hide')
                $("#top-bar").load(location.href + " #top-bar>*");

                setTimeout(() => {
                    // location.href = "index.php"
                }, 1000);
            }

        });

    })

    // $(document).on('click', '#removeBtn', function () {
    //     // e.preventDefault()
    //     var item = $(this).attr("data-id")
    //     // var productId = $("#productId").val()
    //     $.ajax({
    //         type: "post",
    //         url: "response.php",
    //         data: { item: item },
    //         // datatype: "html",
    //         success: function (response) {
    //             // console.log()
    //             Swal.fire(
    //                 'Eliminado!',
    //                 'El producto ha sido eliminado del carrito.',
    //                 'success'
    //             )

    //             // $('.product-modal').modal('hide')
    //             $("#top-bar").load(location.href + " #top-bar>*");
    //             $("#cartTable").load(location.href + " #cartTable>*");
    //             var html = `<section class="empty-cart page-wrapper">
    //                         <div class="container">
    //                             <div class="row justify-content-center">
    //                                 <div class="col-md-6 col-md-offset-3">
    //                                     <div class="block text-center">
    //                                         <i class="tf-ion-ios-cart-outline"></i>
    //                                         <h2 class="text-center">Su carrito está vacío.</h2>
    //                                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, sed.</p>
    //                                         <a href="index.php" class="btn btn-primary mt-20">Volver a la tienda</a>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </section>`;

    //             $("#response").append(html)

    //             setTimeout(() => {
    //                 // location.href = "index.php"
    //             }, 1000);
    //         }

    //     });

    // })
});