function changeStatus(id) {

    $.ajax({
        url: change_like_status_ajax,
        type: "POST",
        data: {
            "_token": csrf,
            'id': id
        },
        dataType: 'json',
        success: function (data) {
           $( "#count" ).text(data.likeCount)
        },
        error: function (msg) {
            if(msg.status === 401){
                alert('Please login or register.');
            } else {
                alert('Error');
            }
        }
    });

}
