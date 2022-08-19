// Ocultar barra del menu

let botonToggle = document.querySelector('#toggleMenu');
let sidebar = document.querySelector('#sidenav-main');
let contenido = document.querySelector('.main-content');

botonToggle.addEventListener('click', (event) => {
    sidebar.toggleAttribute('hidden');

    let show = sidebar.getAttribute("hidden");
    if(show == null){
        contenido.style.marginLeft = "274px";
    }else{
        contenido.style.marginLeft = "0px";
    }
});

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

// Grafico en pantalla de metricas
let ingreso_moviles = null;
let desvio_medio = null;
let top_desvios = null;
let cantidad_desvios = null;

let ctx1 = document.getElementById("ingreso_moviles");
let ctx2 = document.getElementById("desvio_medio");
let ctx3 = document.getElementById("top_desvios");
let ctx4 = document.getElementById("cantidad_desvios");


Livewire.on('updateGraph', (grafica1, grafica3, grafica4) => {

    // Elimina los graficos ya creados
    if (ingreso_moviles !== null) {
        ingreso_moviles.destroy();
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




Livewire.on('updateGraficoDesviosMedios', (grafica2) => {
    if (desvio_medio !== null) {
        desvio_medio.destroy();
    }

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
});