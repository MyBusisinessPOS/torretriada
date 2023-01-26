$(document).ready(function() {    
    $('#checkuser').blur(function(){

        $('#valuser').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">45% Complete</span></div></div>');

        var username = $(this).val();        
        var dataString = 'username='+username+'&operaciones=verificarusuario';

        $.ajax({
            type: "POST",
            url: "operaciones.php",
            data: dataString,
            success: function(data) {
                $('#valuser').show("slow").html(data);
            }
        });
    });
    $('#emailC').blur(function(){
        $('#valuser').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">45% Complete</span></div></div>');

        var email = $(this).val();        
        var dataString = 'correo='+email+'&operaciones=verificarCorreo';

        $.ajax({
            type: "POST",
            url: "operaciones.php",
            data: dataString,
            success: function(data) {
                if(data == 1){
                    $('#valuser').show("slow").html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Bien hecho!</strong> Correo disponible.</div>');
                    $('.buttonguardar').prop('disabled', false);
                }
                if(data == 0){
                     $('#valuser').show("slow").html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Advertencia!</strong> Este correo ya existe o es su actual correo, para poder continuar intente con otro nombre.</div>');
                     $('.buttonguardar').prop('disabled', true);
                }
               
            }
        });
    });                         
});

function validar_campos(){
    var filter=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if ( $('#checkuser').is('[disabled]') ){
        $('#nomuser').removeClass("form-group has-error").addClass("form-group");
    }else{
        if (form1.nomuser.value == ''){
            form1.nomuser.focus();
            $('#nomuser').removeClass("form-group").addClass("form-group has-error");
            $('.top-right').notify({
                message: { text: 'El nombre de usuario esta vacío, llene el campo para poder continuar' },
                type:'blackgloss',
            }).show();
            return false;
        }else{
            $('#nomuser').removeClass("form-group has-error").addClass("form-group has-success");
        }   
    }
    if ( $('#usepass').is('[disabled]') ){
       $('#pass').removeClass("form-group has-error").addClass("form-group");
    }else{
        if (form1.pass.value == ""){
            form1.pass.focus();
            $('#pass').removeClass("form-group").addClass("form-group has-error");
            $('.top-right').notify({
                message: { text: 'El campo contraseña esta vacío, llene este campo para poder continuar' },
                type:'blackgloss',
            }).show();  
            return false;
        }else{
            $('#pass').removeClass("form-group has-error").addClass("form-group has-success");
        }   
    }
    if ( $('#userepass').is('[disabled]') ){
        $('#repass').removeClass("form-group has-error").addClass("form-group");
    }else{
        if (form1.repass.value == ""){
            form1.repass.focus();
            $('#repass').removeClass("form-group").addClass("form-group has-error");
            $('.top-right').notify({
                message: { text: 'El escriba de nuevo la contraseña para poder continuar' },
                type:'blackgloss',
            }).show();  
            return false;
        }
        else{
            $('#repass').removeClass("form-group has-error").addClass("form-group has-success");
        }   
    }
    if ( $('#userepass').is('[disabled]') && $('#userpass').is('[disabled]') ){
        $('#repass').removeClass("form-group has-error").addClass("form-group");
        $('#pass').removeClass("form-group has-error").addClass("form-group");
    }else{
        if (form1.pass.value != form1.repass.value){
            form1.repass.focus();
            $('#repass').removeClass("form-group").addClass("form-group has-error");
            $('.top-right').notify({
                message: { text: 'Las contraseñas no coinciden, verifique que sea la misma para poder continuar' },
                type:'blackgloss',
            }).show();  
            return false;
        }else{
            $('#repass').removeClass("form-group has-error").addClass("form-group has-success");
        }
    }    
    if (form1.nombre.value == ''){
        form1.nombre.focus();
        $('#nombre').removeClass("form-group").addClass("form-group has-error");
        $('.top-right').notify({
            message: { text: 'Este campo es requerido para poder continuar' },
            type:'blackgloss',
        }).show();
        return false;
    }else{
        $('#nombre').removeClass("form-group has-error").addClass("form-group has-success");
    }
    if (form1.nombre.value == ''){
        form1.nombre.focus();
        $('#nombre').removeClass("form-group").addClass("form-group has-error");
        $('.top-right').notify({
            message: { text: 'Este campo es requerido para poder continuar' },
            type:'blackgloss',
        }).show();
        return false;
    }else{
        $('#nombre').removeClass("form-group has-error").addClass("form-group has-success");
    }
    if(form1.email.value == ''){
        form1.email.focus();
        $('#email').removeClass("form-group").addClass("form-group has-error");
        $('.top-right').notify({
            message: { text: 'Este no es un correo válido' },
            type:'blackgloss',
        }).show();
        return false;
    }else{
        $('#email').removeClass("form-group has-error").addClass("form-group has-success");
    }
    if(filter.test(form1.email.value)){
        $('#nombre').removeClass("form-group has-error").addClass("form-group has-success");
    }else{
        form1.email.focus();
        $('#email').removeClass("form-group").addClass("form-group has-error");
        $('.top-right').notify({
            message: { text: 'Este no es un correo válido' },
            type:'blackgloss',
        }).show();
        return false;
    }
    if($('#typeuser').val()==0){
        $('.top-right').notify({
            message: { text: 'Seleccione un tipo de usuario' },
            type:'blackgloss',
        }).show();
        return false;
    }
} 
function cambiar(){
    if($("#nameuser").is(':checked')) {  
        $("#checkuser").attr('disabled',false);
    } else {  
        $("#checkuser").attr('disabled',true); 
    }  
}
function cambiar2(){
    if($("#contraseña").is(':checked')) {  
        $("#usepass").attr('disabled',false);
        $("#userepass").attr('disabled',false);
    } else {  
        $("#usepass").attr('disabled',true);
        $("#userepass").attr('disabled',true); 
    }  
}
function cambiar3(){
    if($("#emailCh").is(':checked')) {  
        $("#emailC").attr('disabled',false);
    } else {  
        $("#emailC").attr('disabled',true);
    }  
}  
function validar_campos_tipo(){
    if (form1.titulo.value == ''){
        form1.titulo.focus();
        $('#titulo').removeClass("form-group").addClass("form-group has-error");
        $('.top-right').notify({
            message: { text: 'El campo del nombre del estado esta vacío, llene este campo para poder continuar' },
            type:'blackgloss',
        }).show();
        return false;
    }else{
        $('#titulo').removeClass("form-group has-error").addClass("form-group has-success");
    }   
} 