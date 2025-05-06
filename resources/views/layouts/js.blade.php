<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function delete_confirm(id, url) {
            // console.log(id, url);
            Swal.fire({
                title: "Kamu Yakin?",
                text: "Data Akan Terhaspus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: 'DELETE',
                        beforeSend: function() {
                            $('#btn-hapus' + id).attr('disabled', 'disabled');
                            $('#btn-hapus' + id).html('<i class="fa fa-spinner fa-spin"></i> Hapus');
                        },
                        complete: function() {
                            $('#btn-hapus' + id).removeAttr('disabled');
                            $('#btn-hapus' + id).html('<i class="fa fa-trash"></i> Hapus');
                        },
                        success: function(response) {
                            setTimeout(function() {
                        location.reload();
                    }, 2500);
                    },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                            // Swal.fire({
                            //     icon: 'error',
                            //     title: 'Failed!',
                            //     text: 'Failed to delete data. Please check your connection.',
                            //     showConfirmButton: true
                            // });
                            notify_js('top', 'right', '', 'warning', 'animated fadeInDown', 'animated fadeOutUp', response.message);

                        }
                    });
                }
            });
        }
</script>