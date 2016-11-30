validate = function(obj) {
    $("#area-form").validate({
        rules:{
            nome: {
                required:true,
                custom_valid_name:true,
                minlength:3,
                maxlength:50
            },
            descricao: {
                required:true,
                custom_valid_name:true,
                minlength:10,
                maxlength:50
            }

        },
        messages:{
            nome: {
                required: "Nome obrigatório",
                minlength:"Nome deve conter pelo menos 3 letras",
                maxlength:"Nome deve conter no máximo 50 letras"
            },
            descricao: {
                required: "Descrição obrigatória",
                minlength:"Descrição deve conter pelo menos 10 letras",
                maxlength:"Descrição deve conter no máximo 50 letras"
            }

        }
    })

    $("#usuario-form").validate({
        rules:{
            login: {
                required:true,
                minlength:3,
                maxlength:50,
                remote: {
                    url: '/src/model/check_login.php',
                    type: 'post'
                }
            },
            nome: {
                required:true,
                custom_valid_name:true,
                minlength:3,
                maxlength:50
            },
            email: {
                required:true,
                custom_valid_email:true,
                minlength:3,
                maxlength:50
            },
            pontos: {
                required:true,
                minlength:1,
                number: true
            },
            senha: {
                minlength: 5,
            },
            confirmaSenha : {
                minlength: 5,
                equalTo: "#senha"
            }

        },
        messages:{
            login: {
                required: "Login obrigatório",
                minlength:"Login deve conter pelo menos 3 letras",
                maxlength:"Login deve conter no máximo 50 letras",
                remote: "Login já cadastrado"
            },
            nome: {
                required: "Nome obrigatório",
                minlength:"Nome deve conter pelo menos 3 letras",
                maxlength:"Nome deve conter no máximo 50 letras"
            },
            email: {
                required: "Email obrigatório",
                minlength:"Email deve conter pelo menos 3 letras",
                maxlength:"Email deve conter no máximo 50 letras"
            },
            pontos: {
                required: "Pontos obrigatórios",
                minlength:"Pontos devem conter pelo menos 1 número",
                number:"Pontos devem ser numéricos"
            },
            senha: {
                minlength:"Senha deve conter pelo menos 5 letras"
            },
            confirmaSenha: {
                minlength:"Senha deve conter pelo menos 5 letras",
                equalTo : "Valores diferentes"
            },

        }
    })
    $("#ideia-form").validate({
        rules:{
            nome: {
                required:true,
                custom_valid_name:true,
                minlength:3,
                maxlength:50
            },
            descricao: {
                required:true,
                custom_valid_name:true,
                minlength:10,
                maxlength:50
            }

        },
        messages:{
            nome: {
                required: "Nome obrigatório",
                minlength:"Nome deve conter pelo menos 3 letras",
                maxlength:"Nome deve conter no máximo 50 letras"
            },
            descricao: {
                required: "Descrição obrigatória",
                minlength:"Descrição deve conter pelo menos 10 letras",
                maxlength:"Descrição deve conter no máximo 50 letras"
            }

        }
    })
    $("#premio-form").validate({
        rules:{
            nome: {
                required:true,
                custom_valid_name:true,
                minlength:3,
                maxlength:50
            },
            pontos: {
                required:true,
                minlength:1,
                number: true
            }

        },
        messages:{
            nome: {
                required: "Nome obrigatório",
                minlength:"Nome deve conter pelo menos 3 letras",
                maxlength:"Nome deve conter no máximo 50 letras"
            },
            pontos: {
                required: "Pontos obrigatórios",
                minlength:"Pontos devem conter pelo menos 1 número",
                number:"Pontos devem ser numéricos"
            }

        }
    })
    jQuery.validator.addMethod("custom_valid_email",function(value,element){
        return this.optional(element) || /\w[-._\w]*\w@\w[-._\w]*\w\.\w{2,3}/.test(value);
    },"Email inválido");
    jQuery.validator.addMethod("custom_valid_name",function(value, element){
        return this.optional(element) || /(^[a-z,A-Z]+\s?)/.test(value);
    },"Nome inválido");
}
