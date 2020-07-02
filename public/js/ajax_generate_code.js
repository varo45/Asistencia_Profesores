$(document).ready(function() {
    $("#codeForm").submit(function(){
        $.ajax({
            url:'index.php?ACTION=qrcoder',
            type:'POST',
            data: {formData:$("#content").val(), ecc:$("#ecc").val(), size:$("#size").val()},
            success: function(response) {
                $(".showQRCode").html(response);  
            },
         });
    });
});