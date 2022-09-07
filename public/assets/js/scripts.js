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

// Grafico en pantalla
let ingreso_moviles = null;
let desvio_medio = null;
let top_desvios = null;
let cantidad_desvios = null;
let descarga_dock = null;
let descarga_movil = null;
let vela_alerta_tiempo = null;
let vela_alerta_cantidad = null;

let ctx1 = document.getElementById("ingreso_moviles");
let ctx2 = document.getElementById("desvio_medio");
let ctx3 = document.getElementById("top_desvios");
let ctx4 = document.getElementById("cantidad_desvios");
let ctx5 = document.getElementById("descarga_dock");
let ctx6 = document.getElementById("descarga_movil");
let ctx7 = document.getElementById("vela_alerta_tiempo");
let ctx8 = document.getElementById("vela_alerta_cantidad");


Livewire.on('updateGraficoIngresoMoviles', (grafica) => {
    if (ingreso_moviles !== null) {
        ingreso_moviles.destroy();
    }
    
    ingreso_moviles = new Chart(ctx1, {
        type: "bar",
        data: grafica,
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
});


Livewire.on('updateGraficoDesviosMedios', (grafica) => {
    if (desvio_medio !== null) {
        desvio_medio.destroy();
    }

    desvio_medio = new Chart(ctx2, {
        type: "bar",
        data: grafica,
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


Livewire.on('updateGraficoTopDesvios', (grafica) => {
    if (top_desvios !== null) {
        top_desvios.destroy();
    }

    top_desvios = new Chart(ctx3, {
        type: "bar",
        data: grafica,
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

Livewire.on('updateGraficoAnomaliasHora', (grafica) => {
    if (cantidad_desvios !== null) {
        cantidad_desvios.destroy();
    }

    cantidad_desvios = new Chart(ctx4, {
        type: "bar",
        data: grafica,
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

Livewire.on('updateGraficoDescargaDock', (grafica) => {
    if (descarga_dock !== null) {
        descarga_dock.destroy();
    }
    
    descarga_dock = new Chart(ctx5, {
        type: "bar",
        data: grafica,
        options: {
            animation: false,
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Dock' } }],
                yAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Horas' } }],
            },
            color: '#FFF',
        }
    });
});

Livewire.on('updateGraficoDescargaMovil', (grafica) => {
    if (descarga_movil !== null) {
        descarga_movil.destroy();
    }
    
    descarga_movil = new Chart(ctx6, {
        type: "bar",
        data: grafica,
        options: {
            animation: false,
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Dock' } }],
                yAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Horas' } }],
            },
            color: '#FFF',
        }
    });
});

Livewire.on('updateGraficoVelaTiempo', (grafica) => {
    if (vela_alerta_tiempo !== null) {
        vela_alerta_tiempo.destroy();
    }

    vela_alerta_tiempo = new Chart(ctx7, {
        type: "bar",
        data: grafica,
        options: {
            animation: false,
            responsive: true,
            maintainAspectRatio: false,
            color: '#FFF',
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });
});

Livewire.on('updateGraficoVelaCantidad', (grafica) => {
    if (vela_alerta_cantidad !== null) {
        vela_alerta_cantidad.destroy();
    }

    vela_alerta_cantidad = new Chart(ctx8, {
        type: "bar",
        data: grafica,
        options: {
            animation: false,
            responsive: true,
            maintainAspectRatio: false,
            color: '#FFF',
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });
});
