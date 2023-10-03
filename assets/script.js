
$(document).ready(function () {

    //Mascara de dinheiro
    $('.money').mask('000.000.000.000.000,00', { reverse: true });


    //Enviar formulario de cadastro de conta
    $("#formContas").submit(function (e) {
        e.preventDefault();

        var empresaId = $("#empresaSelect").val();
        var dataPagar = $("#dataPagamento").val();
        var valor = $("#valorPagamento").val();

        $.ajax({
            url: "api/cadastro/cadastrar_conta.php",
            type: "POST",
            data: {
                empresaId: empresaId,
                dataPagar: dataPagar,
                valor: valor
            },
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            }
        });
    });

    //Enviar formulario de edição de conta
    $("#formEditarConta").submit(function (e) {
        e.preventDefault();

        var dataPagar = $("#dataPagamento").val();
        var valor = $("#valorPagamento").val();
        var contaId = $("#idContaPagar").val();
        $.ajax({
            url: "api/acoes/editar_conta.php",
            type: "POST",
            data: {
                dataPagar: dataPagar,
                valor: valor,
                contaId: contaId
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    alert(data.message);
                    window.location.href = "index.php";
                } else {
                    alert(data.message);
                }
            }
        });
    });


    //Listar empresas no select empresaSelect
    $.ajax({
        url: "api/listagem/list_empresas.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
            var html = "";
            for (var i = 0; i < data.length; i++) {
                html += "<option value='" + data[i].id_empresa + "'>" + data[i].nome + "</option>";
            }
            $("#empresaSelect").append(html);
        }
    });


    function listarTabela() {
        $.ajax({
            url: "api/listagem/list_contas.php",
            type: "GET",
            dataType: "json",
            data: {
                empresa: $("#filtroEmpresa").val(),
                valor: $("#filtroValor").val(),
                data: $("#filtroData").val(),
                condicao: $("#filtroCondicao").val()
            },
            success: function (data) {
                $("#tabelaContas").empty();

                var html = "";
                for (var i = 0; i < data.length; i++) {
                    for (var i = 0; i < data.length; i++) {
                        html += "<tr>";
                        html += "<td>" + data[i].nome_empresa + "</td>";
                        html += "<td>" + data[i].data_pagar + "</td>";

                        //Formata o valor para R$ xx,xx
                        var valorFormatado = data[i].valor.toLocaleString('pt-br', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });

                        var valorFormatado_pago = data[i].valor_pago.toLocaleString('pt-br', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        });

                        //Verifica se a conta está paga ou não
                        botao = "";
                        if (data[i].pago == 1) {
                            data[i].pago = "Pago";
                        } else {
                            data[i].pago = "Pendente";
                            botao = "<button class='btn btn-success mr-2' onclick='marcarContaComoPaga(" + data[i].id_conta_pagar + ")'>Marcar como Pago</button>";
                        }

                        html += "<td>R$ " + valorFormatado.replace('.', ',') + "</td>";
                        html += "<td>" + (valorFormatado_pago ? "R$ " + valorFormatado_pago.replace('.', ',') : "nulo") + "</td>";
                        html += "<td>" + data[i].pago + "</td>";
                        html += "<td class='text-center'>";
                        html += "<button class='btn btn-danger mr-2' onclick='deleteConta(" + data[i].id_conta_pagar + ")'>Excluir</button>";
                        html += "<button class='btn btn-primary mr-2' onclick='editConta(" + data[i].id_conta_pagar + ")'>Editar</button>";
                        html += botao;
                        html += "</td>";


                        html += "</tr>";
                    }
                }

                $("#tabelaContas").append(html);
            }
        });
    }

    $("#aplicarFiltros").click(function () {
        listarTabela();
    });

    //Limpar filtros
    $("#limparFiltros").click(function () {
        $("#filtroEmpresa").val("");
        $("#filtroValor").val("");
        $("#filtroData").val("");
        $("#filtroCondicao").val("");
        listarTabela();
    });

    listarTabela();
});


function deleteConta(contaId) {
    if (confirm("Deseja realmente excluir essa conta?")) {
        $.ajax({
            url: "api/acoes/delete_conta.php",
            type: "POST",
            data: {
                idContaPagar: contaId
            },
            dataType: "json",
            success: function (data) {
                console.log(contaId);
                if (data.status == 1) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            }
        });
    }
}


function editConta(contaId) {
    window.location.href = "editar.php?idContaPagar=" + contaId;
}

function marcarContaComoPaga(contaId) {
    if (confirm("Deseja realmente marcar essa conta como paga?")) {
        $.ajax({
            url: "api/acoes/marcar_pago.php",
            type: "POST",
            data: {
                contaId: contaId
            },
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            }
        });
    }
}

