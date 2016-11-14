actived = function(obj) {
    var url = document.URL;
    if (new RegExp('auth/home').test(url)){
        $("#menuhome").parent().addClass('active');
    } else if (new RegExp('auth/ideia').test(url)){
        $("#menuideia").parent().addClass('active');
    } else if (new RegExp('auth/premio').test(url)){
        $("#menupremio").parent().addClass('active');
    } else if (new RegExp('auth/area').test(url)){
        $("#menuarea").parent().addClass('active');
    } else if (new RegExp('auth/usuario').test(url)){
        $("#menuusuario").parent().addClass('active');
    }
}
