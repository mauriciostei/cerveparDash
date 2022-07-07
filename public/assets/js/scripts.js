// Notificaciones
Livewire.on('nuevaAlerta', (param) => {
    let caja = document.querySelector("#apartadoParaAlertas");

    let alerta = ''+
            '<div class="toast fade" id="newToastAutoGenerate'+param.id+'">'+
               '<div class="toast-header border-0">'+
                    '<i class="material-icons text-warning me-2">check</i>'+
                    '<span class="me-auto font-weight-bold">Mensaje del Sistema</span>'+
                    '<i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>'+
                '</div>'+
                '<hr class="horizontal dark m-0">'+
                '<div class="toast-body">'+
                    'Nueva Alerta detectada, para trabajarla click <a href="/alertas/'+param.id+'">aqui</a>'+
                '</div>'+
            '</div>'+
        '';
    caja.innerHTML += alerta;

    var element = document.querySelector("#newToastAutoGenerate"+param.id);
    var myToast = new bootstrap.Toast(element, { delay: 3000 });
    myToast.show();
});

// Accuracy grafica del inicio
let myChart = null;
var ctx = document.getElementById("accuracy-chart");
// if(ctx !==null){ ctx = document.getElementById("accuracy-chart").getContext("2d"); }

Livewire.on('accuracyGrap', (porcentaje) => {

    if (myChart !== null) {
        myChart.destroy();
    }

    const pieData = {
        labels: [
            "Logrado",
            "Pendiente",
        ],
        datasets: [{
            data: [ porcentaje, 100 - porcentaje ],
            backgroundColor: [
                "#37CBFF",
                "#F6AB16",
            ],
            hoverOffset: 4,
        }],
    };

    myChart = new Chart(ctx, {
    type: 'doughnut',
    data: pieData,
    options: {
        animation: false,
        plugins: {
            datalabels: {
                anchor: "center",
                formatter: (dato) => dato + "%",
            }
        },
        color: '#FFF',
        responsive: true,
        rotation: 270,
        circumference: 180,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }

    }
    });
})


// Grafico en pantalla de metricas
let ingreso_moviles = null;
let desvio_medio = null;
let top_desvios = null;
let cantidad_desvios = null;

let ctx1 = document.getElementById("ingreso_moviles");
// if(ctx !== null){ ctx = ctx.getContext("2d"); }
let ctx2 = document.getElementById("desvio_medio");
// if(ctx !== null){ ctx = ctx.getContext("2d"); }
let ctx3 = document.getElementById("top_desvios");
// if(ctx !== null){ ctx = ctx.getContext("2d"); }
let ctx4 = document.getElementById("cantidad_desvios");
// if(ctx !== null){ ctx = ctx.getContext("2d"); }


Livewire.on('updateGraph', (grafica1, grafica2, grafica3, grafica4) => {

    // Elimina los graficos ya creados
    if (ingreso_moviles !== null) {
        ingreso_moviles.destroy();
    }
    if (desvio_medio !== null) {
        desvio_medio.destroy();
    }
    if (top_desvios !== null) {
        top_desvios.destroy();
    }
    if (cantidad_desvios !== null) {
        cantidad_desvios.destroy();
    }

    // Grafica de ingreso de moviles
    ingreso_moviles = new Chart(ctx1, {
        type: "bar",
        data: grafica1,
        options: {
            animation: false,
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Horas' } }],
                yAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Cantidad' } }],
            },
            color: '#FFF',
        }
    });

    // Grafica de desvios medios
    desvio_medio = new Chart(ctx2, {
        type: "bar",
        data: grafica2,
        options: {
            animation: false,
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Horas' } }],
                yAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Cantidad' } }]
            },
            color: '#FFF',
        }
    });

    // Grafica de top desvios
    top_desvios = new Chart(ctx3, {
        type: "bar",
        data: grafica3,
        options: {
            animation: false,
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Horas' } }],
                yAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Cantidad' } }]
            },
            color: '#FFF',
        }
    });

    // Grafica de cantidad de anomalias
    cantidad_desvios = new Chart(ctx4, {
        type: "bar",
        data: grafica4,
        options: {
            animation: false,
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Horas' } }],
                yAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Cantidad' } }]
            },
            color: '#FFF',
        }
    });

});