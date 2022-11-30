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

    $('#like').click(function () {

        var id = $(this).attr("data-id")
        $.ajax({
            type: "POST",
            url: "response.php",
            data: {
                productId: id
            },
            success: function (response) {
                if (response == 200) {
                    $('#icon').addClass('text-danger bxs-heart')
                    $("#numlikes").load(location.href + " #numlikes");

                }

            }
        });
    })

    // if (top.location.pathname === '/aniria_cosmetics/product-details.php') {
    //     var id = $('.like').attr("data-id")
    //     $.ajax({
    //         type: "GET",
    //         url: "response.php",
    //         data: { id: id },
    //         success: function (response) {
    //             if (response == 200) {
    //                 $('.like').css('color', 'red')
    //                 console.log(response);
    //             }
    //         }
    //     });
    // }

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
            }

        });

    })


    // $("#comment").click(function () {
    $("#comment-form").submit(function (e) {
        e.preventDefault();
        var comment = $("#comment").val()
        if (comment.length == 0) {
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "response.php",
                data: $(this).serialize(),
                success: function (response) {
                    if (response == 200) {
                        $("#comment-form")[0].reset()
                        $("#comment-section").load(location.href + " #comment-section>*");
                    }
                }
            });
        }
    });

});
