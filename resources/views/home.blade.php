@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Lista de Vendas</h1>

    <!-- Filtro por período -->
    <div class="row mb-4">
        <div class="col-md-4">
            <label for="start-date" class="form-label">Data de Início</label>
            <input type="date" id="start-date" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="end-date" class="form-label">Data de Fim</label>
            <input type="date" id="end-date" class="form-control">
        </div>
        <div class="col-md-4 align-self-end">
            <button class="btn btn-primary w-100" onclick="filterSales()">Filtrar</button>
        </div>
    </div>

    <!-- Botão para adicionar nova venda -->
    <div class="mb-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSaleModal">Adicionar Nova Venda</button>
    </div>

    <!-- Lista de vendas -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Data e Hora</th>
                    <th>Produto</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="sales-list">
                <!-- Linhas de vendas serão adicionadas aqui dinamicamente -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para adicionar nova venda -->
<div class="modal fade" id="addSaleModal" tabindex="-1" aria-labelledby="addSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSaleModalLabel">Adicionar Nova Venda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSaleForm">
                    <div class="mb-3">
                        <label for="sale-date" class="form-label">Data e Hora</label>
                        <input type="datetime-local" id="sale-date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="sale-product" class="form-label">Produto</label>
                        <select id="sale-product" class="form-select" required>
                            <option value="">Selecione um produto</option>
                            <option value="1">Produto A</option>
                            <option value="2">Produto B</option>
                            <option value="3">Produto C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sale-value" class="form-label">Valor</label>
                        <input type="number" step="0.01" id="sale-value" class="form-control" required>
                    </div>
                    <input type="hidden" id="sale-lat">
                    <input type="hidden" id="sale-lon">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveSale()">Salvar Venda</button>
            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Obter localização atual ao carregar a página
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                document.getElementById('sale-lat').value = position.coords.latitude;
                document.getElementById('sale-lon').value = position.coords.longitude;
            }, (error) => {
                console.error("Erro ao obter geolocalização: ", error);
            });
        } else {
            console.error("Geolocalização não suportada pelo navegador.");
        }
    });

    async function setAuthToken() {
    // Aqui você pode implementar a lógica para obter o token
    const token = 'SEU_TOKEN_AQUI'; // Substitua por sua lógica de obtenção do token
    localStorage.setItem('auth_token', token);
}

    async function saveSale() {
        await setAuthToken();
        const saleDate = document.getElementById('sale-date').value;
        const saleProduct = document.getElementById('sale-product').value;
        const saleValue = document.getElementById('sale-value').value;
        const saleLat = document.getElementById('sale-lat').value;
        const saleLon = document.getElementById('sale-lon').value;

        try {
            const response = await fetch('/api/vendas', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
                },
                body: JSON.stringify({
                    sale_date: saleDate,
                    sale_product: saleProduct,
                    sale_value: saleValue,
                    sale_lat: saleLat,
                    sale_lon: saleLon
                })
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Network response was not ok');
            }

            const data = await response.json();
            console.log(data); // Verifique a resposta completa
            if (data.success) {
                alert('Venda salva com sucesso!');
                // Atualize a lista de vendas ou outra ação
            } else {
                alert('Erro ao salvar a venda');
            }
        } catch (error) {
            console.error('Erro ao salvar a venda:', error);
            alert('Erro ao salvar a venda');
        }
    }
</script>

@endpush