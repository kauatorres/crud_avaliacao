<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas a Pagar</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Mascara -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <!-- Scripts -->
    <script src="assets/script.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Contas a Pagar</h1>

        <form id="formContas">
            <div class="form-group">
                <label for="empresaSelect">Empresa:</label>
                <select class="form-control" id="empresaSelect" name="empresaSelect" required>
                    <option value="">Selecione uma empresa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="dataPagamento">Data de Pagamento:</label>
                <input type="date" class="form-control" id="dataPagamento" name="dataPagamento" required>
            </div>
            <div class="form-group">
                <label for="valorPagamento">Valor a ser pago (R$):</label>
                <input type="text" class="form-control money" id="valorPagamento" name="valorPagamento" required>
            </div>
            <button type="submit" class="btn btn-primary">Inserir</button>
        </form>

        <div class="mt-4">
            <h3>Filtros</h3>
            <form method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="filtroEmpresa">Filtrar por Nome da Empresa:</label>
                            <input type="text" class="form-control" id="filtroEmpresa" name="empresa">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="filtroValor">Ordenar por Valor:</label>
                            <select class="form-control" id="filtroCondicao" name="condicao">
                                <option value="">Selecione uma opção</option>
                                <option value="MAIOR">Maior ao Menor</option>
                                <option value="MENOR">Menor ao Maior</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="filtroValor">Filtrar por Valor:</label>
                            <input type="text" class="form-control money" id="filtroValor" name="valor">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="filtroData">Filtrar por Data de Pagamento:</label>
                            <input type="date" class="form-control" id="filtroData" name="data">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="aplicarFiltros">Aplicar Filtros</button>
                <button type="button" class="btn btn-warning" id="limparFiltros">Limpar Filtros</button>
            </form>
        </div>

        <table class="table mt-4 mb-4">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Data de Pagamento</th>
                    <th>Valor</th>
                    <th>Valor pago</th>
                    <th>Status</th>
                    <th class='text-center'>Ações</th>
                </tr>
            </thead>
            <tbody id="tabelaContas">
            </tbody>
        </table>


    </div>
</body>

</html>