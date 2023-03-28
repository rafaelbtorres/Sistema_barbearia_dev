(function barbearia_form(){
    const data = new Date();
    /* 
    O mês do JS é contado de 0-11. Então para a lógica funcionar 
    corretamente buscando limitar o mês anterior, é preciso fazer
    o teste lógico abaixo
    */
    const mesAtual = data.getMonth();
    const mesInvalido = mesAtual == 0 ? 12: mesAtual;

    const diaAtual = data.getDate();

    // Data
    $('.datepicker').pickadate({
        formatSubmit: 'yyyy/mm/dd',
        hiddenName: true,
        hiddenPrefix: 'prefix__',
        hiddenSuffix: '__suffix',
        klass: {
            navPrev: 'picker__nav--next',
            navNext: 'picker__nav--prev',
        },
        min: new Date(2020, mesInvalido, diaAtual),
        disable: [
            1
        ],
    })
})();

function handleButton(target){
    const btnAttribute = target.getAttribute("data-target-title");
    const btn = document.querySelector(`#${btnAttribute}`);
    
    if(target.value.length > 0){
        btn.removeAttribute("disabled");
    } 
    else{
        btn.setAttribute("disabled", "disabled");
    }
}

function handleCheck(target){
    const btnAttribute = target.getAttribute("data-target-title");
    const btn = document.querySelector(`#${btnAttribute}`);
    
    if(target.checked){
        btn.removeAttribute("disabled");
    } 
    else{
        const checkeds = document.querySelectorAll("input:checked");
        const InputChecked = Array.from(checkeds);
        InputChecked.length == 0 ? btn.setAttribute("disabled", "disabled"): ""
    }
}


function confirmarServico(){

    console.log("KLJKLJSADKLJSDKLJ");
    const preInfos = [
        {text: "Data:"},
        {text: "Horário:"},
        {text: "Serviço:"},
        {text: "Filial:"},
        {text: "Cabeleleiro:"},
    ] 

    const posInfos = []
    
    // Inputs
    const dia = document.querySelector("#dia-agendamento").value;
    const horario = document.querySelector("#horario-agendamento").value;
    let servicos = ``;
    // Pegandos os serviços escolhidos
    const checkeds = document.querySelectorAll("input:checked");
    const servicosEscolhidos = Array.from(checkeds);
    servicosEscolhidos.forEach((servico, index) =>{
        servicos += `${servico.value}`;
        const ultimoItem = (servicosEscolhidos.length) - 1;
        ultimoItem != index ? servicos += " | ": ""
    });

    // Filial
    const filial = $("#filial option:selected").text();
    const cabeleleiro = $("#cabeleleiro option:selected").text();

    posInfos.push(dia, horario, servicos, filial, cabeleleiro);

    let confirmarServico = document.querySelector("#confirmar-servico-content");
    confirmarServico.innerHTML = ``;

    const finalInfos = preInfos.map((info, index) => {
        const textContainer = document.createElement("h5");

        textContainer.setAttribute("class", "multisteps-form__title sb-txt-white sb-w-500");
        textContainer.innerHTML = `${info.text} ${posInfos[index]}`;

        return textContainer.outerHTML;
    });

    // Inserindo os valores dinamicamente
    finalInfos.forEach(info => {
        confirmarServico.innerHTML += info;
    })
}

/*const btnServico = document.querySelector("#btn-servico");
btnServico.addEventListener("click", confirmarServico);*/
$("#btn-cabeleleiro").on('click', function(e){
    confirmarServico();
});

$(document).ready(function(){
    $("#filial").on('change', function(e){
        if(e.target.value === ""){
            $(".info-filial").html(``);
            $("#cabeleleiro").html('<option value="">Aleatório</option>');
            return;
        }
        setTimeout(function(){
            var data = JSON.parse($("#filial option:selected").attr('data-filial'));
            
            $(".info-filial").html(`
                Nome: ${data.nome}<br>
                Endereço: ${data.rua}, Nº: ${data.numero}, ${data.bairro}, ${data.cidade} - ${data.estado}<br>
                Telefone: ${data.telefone}
            `);


            // Adicionar os cabeleleiros desta filial
            var cabeleleiros = JSON.parse($("#cabeleleiro").attr('data-cabeleleiros'));
            let options = "<option value=''>Aleatório</option>";
            
            for(const cab of cabeleleiros){
                const filiais = cab[4].split(',');
                if(parseInt(cab[4]) === parseInt(data.id))
                    options = options + `<option value='${cab[0]}'>${cab[1]}</option>`;
            }

            $("#cabeleleiro").html(options);

            $(".multisteps-form__form").attr('style', 'height: 340px');
        } , 300);
    })
})