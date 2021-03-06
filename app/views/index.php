<?php

if(!estaLogueado()){
  redirigir('/usuarios/login');
}

console($data);

include_once(APPROOT . '/views/includes/header.inc.php');
?>
<div class="flex-grow p-20 overflow-y-scroll flex flex-col gap-4">
    <div class="flex-none flex flex-nowrap gap-2">
        <a href="#" class="flex-none h-8 px-3 rounded bg-gray-200 flex items-center justify-center">
            <span class="font-medium">Gráficas</span>
        </a>
        <div class="flex-grow h-8 flex justify-end">
            <a href="#" title="Ayuda" class="w-8 h-8 rounded hover:bg-gray-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-help" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="12" y1="17" x2="12" y2="17.01"></line>
                    <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4"></path>
                </svg>
            </a>
        </div>
    </div>
    <div class="flex-none h-96 mb-10 flex flex-col gap-4">
        <label for="" class="flex-shrink w-72 p-px font-medium">Productos</label>
        <div class="flex-none h-96" style="width: 50rem;">
            <canvas id="myChart1"></canvas>
        </div>
    </div>
    <div class="flex-none h-96 mb-10 flex flex-col gap-4">
        <label for="" class="flex-shrink w-72 p-px font-medium">Inventarios</label>
        <div class="flex-none h-96" style="width: 50rem;">
            <canvas id="myChart2"></canvas>
        </div>
    </div>
</div>
<?php

$productos = '';
$productosCantidad = '';
foreach($data['productos'] as $producto){
    $productos .= '"' . $producto -> nombre . '",';
    $productosCantidad .= $producto -> cantidad . ',';
}

$proveedores = '';
$proveedoresTotal = '';
$proveedoresIVA = '';
foreach($data['proveedores'] as $proveedor){
    $proveedores .= '"' . $proveedor -> nombre . '",';
    $proveedoresTotal .= $proveedor -> total . ',';
    $proveedoresIVA .= $proveedor -> iva . ',';
}

?>
<script src="<?= URLROOT; ?>/js/chart.min.js"></script>
<script>
const ctx1 = document.getElementById('myChart1').getContext('2d');
const myChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: [<?= $productos ?>],
        datasets: [{
            label: 'Número de productos',
            data: [<?= $productosCantidad ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const ctx2 = document.getElementById('myChart2').getContext('2d');
const myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: [<?= $proveedores ?>],
        datasets: [{
            label: 'Gastos Proveedores',
            data: [<?= $proveedoresTotal ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },{
            label: 'IVA Proveedores',
            data: [<?= $proveedoresIVA ?>],
            backgroundColor: [
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<?php
include_once(APPROOT . '/views/includes/footer.inc.php');
?>