import fromJSON from "postcss/lib/fromJSON";

$("#btn_delete_user").on('click',()=>{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        id: 1,
    };
    var type = "DELETE";
    $.ajax({
        url:'/ajax/'+formData.id,
        type:type,
        dataType:'json',
        success: (msg) => {
            console.log(msg);
        },
        error: (msg) => {
            var errors = msg.responseJSON;

            console.log(errors);
        }
    })
});

let alert = $('.success-Update');

if(alert.length > 0){
    setTimeout(() => {
        alert.fadeOut();
    },2000);
}else {
    console.log("not here")
}

