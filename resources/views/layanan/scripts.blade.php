<script>
    //form submit
    $('#form-data').submit(function(e) {
        e.preventDefault();
        type = 'post';
        url  = $(this).attr('action');
        var self = $(this)
        let data_post = new FormData(self[0]);

        post_response(url, data_post, function(response) {
            if (response.status) {
                showSwal("success", "Informasi", response.msg).then(function() {
                    window.location.href = "{{ url('manajemen-layanan') }}";
                });
            } else {
                showSwal("error", "Gagal", response.msg);
            }
        });
    });
</script>