(function alerts_login(){
    // ALERTS
    const btnRegistro = document.querySelector("#registre-se");

    const redirecionarUsuario = (endpoint) => {
        Swal.fire({
            icon: 'success',
            title: `Que ótimo!`,
            text: `Vamos te redirecionar para a próxima etapa `,
            showConfirmButton: false
        });
        setTimeout(function() {
            window.location.href = `http://localhost/sistema_barbearia/${endpoint}.php`
        }, 3000);
    }
    btnRegistro.addEventListener("click", (e) => {
        e.preventDefault();
        Swal.fire({
            title: `Estamos quase lá!`, 
            text: `Se você é cliente, basta clicar no botão cliente abaixo. \n Já se você é um dono de barbearia, entre com contato pelo Whatsapp: (55) 98461-8335 para realizarmos seu cadastro e liberar seu plano.`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#202024',
            cancelButtonColor: '#202024',
            // confirmButtonText: 'Dono de barbearia',
            cancelButtonText: 'Cliente'
        }).then((result) => {
            if (result.isConfirmed) {
                // redirecionarUsuario("registro_barbearia");
            }
            else{
                redirecionarUsuario("registro");
            }
        })
    })
})();