$(function () {

    // GLOBALS
    $(".navbar-toggler").click(function () {
        $('i.bx-menu').toggleClass('bx-x animate__animated animate__bounceIn')
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

    $(document).on('click', '.moreinfo', function () {
        var transaction = $(this).attr('data-id')
        $.ajax({
            type: "POST",
            url: "../../admin/orders/moreinfo.php",
            data: {
                transaction: transaction
            },
            success: function (data) {
                console.log(data);
                $("#info").html(data)
            }
        });
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


    $(document).on('submit', '#form_cart', function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "cart_process.php",
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                Swal.fire(
                    'Agregado!',
                    'El producto ha sido agregado al carrito.',
                    'success'
                )
                $('.product-modal').modal('hide')
                $("#top-bar").load(location.href + " #top-bar>*");
            }

        });
    });




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
