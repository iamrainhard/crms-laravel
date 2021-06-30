$(document).ready(function () {
    $('#church_id').html('');
    // $('#churchIdDiv').hide();
    $('#region').hide();
$("#role").on('change', function (){
    let role = this.value;
    // console.log(role);
    if (role === 'member' || role === 'pastor'|| role === 'elder'){
        $('#region').show();
    }else{
        $('#church_id').html('');
        $('#region').hide();
    }
})
    $("#region").on('change', function (){
        let region = this.value;
        $('#church_id').html('');
        $.ajax({
            url: "/get-church-by-region",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                // "_token": "{{ csrf_token() }}",
                region: region,
            },
            dataType: 'json',
            success: function(result) {
                $('#church_id').html('<option selected disabled value="">Select the User\'s Church</option>');
                // $('#role').append('<option value="manager">Hostel Manager</option>');
                $.each(result.churches, function(key, value) {
                    $("#church_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
                // $('#city-dropdown').html('<option value="">Select State First</option>');
            }
        });
    })
})
