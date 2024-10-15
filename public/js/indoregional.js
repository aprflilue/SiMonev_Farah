$(function() {
    $('#provinsi').on('change',function(){
        let id_provinsi = $('#provinsi').val();

        // console.log(id_provinsi);
        $.ajax({
            type : 'POST',
            url : "{{ route('getkabupaten') }}",
            data : {id_provinsi:id_provinsi},
            cache : false,

            success: function(msg){
                $('#kabupaten').html(msg);
                $('#kecamatan').html('');
                $('#desa').html('');
            },
            error: function(data){
                console.log('error:', data)
            },
        })
        
    })
})