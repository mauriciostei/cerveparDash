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
let descarga_dock_2 = null;
let descarga_movil_2 = null;

let ctx1 = document.getElementById("ingreso_moviles");
let ctx2 = document.getElementById("desvio_medio");
let ctx3 = document.getElementById("top_desvios");
let ctx4 = document.getElementById("cantidad_desvios");

let ctx5 = document.getElementById("descarga_dock_t2");
let ctx6 = document.getElementById("descarga_movil_t2");

let ctx7 = document.getElementById("vela_alerta_tiempo");
let ctx8 = document.getElementById("vela_alerta_cantidad");

let ctx9 = document.getElementById("descarga_dock_t1");
let ctx10 = document.getElementById("descarga_movil_t1");

const dock_plugin = {
    beforeDraw: (chart) => {
        const {ctx} = chart;
        const area = chart.chartArea;

        ctx.save();
        ctx.globalCompositeOperation = 'destination-over';

        var espacio = (area.top - area.bottom) / 30;

        var verde = 5 * espacio;
        var amarillo = 4 * espacio;
        var naranja = 5 * espacio;

        ctx.fillStyle = "#4CAF50";
        ctx.fillRect(area.left, area.bottom, area.right - area.left, verde);

        ctx.fillStyle = "#FBD38D";
        ctx.fillRect(area.left, area.bottom + verde, area.right - area.left, amarillo);

        ctx.fillStyle = "#FAC024";
        ctx.fillRect(area.left, area.bottom + (verde + amarillo), area.right - area.left, naranja);
        
        ctx.fillStyle = "#F56565";
        ctx.fillRect(area.left, area.bottom + (verde + amarillo + naranja) + 1, area.right - area.left, area.top - area.bottom);


        ctx.restore();
    }
};

const dock_plugin_t1 = {
    beforeDraw: (chart) => {
        const {ctx} = chart;
        const area = chart.chartArea;

        ctx.save();
        ctx.globalCompositeOperation = 'destination-over';

        var espacio = (area.top - area.bottom) / 200;

        var verde = 15 * espacio;
        var amarillo = 15 * espacio;
        var naranja = 15 * espacio;

        ctx.fillStyle = "#4CAF50";
        ctx.fillRect(area.left, area.bottom, area.right - area.left, verde);

        ctx.fillStyle = "#FBD38D";
        ctx.fillRect(area.left, area.bottom + verde, area.right - area.left, amarillo);

        ctx.fillStyle = "#FAC024";
        ctx.fillRect(area.left, area.bottom + (verde + amarillo), area.right - area.left, naranja);
        
        ctx.fillStyle = "#F56565";
        ctx.fillRect(area.left, area.bottom + (verde + amarillo + naranja) + 1, area.right - area.left, area.top - area.bottom);


        ctx.restore();
    }
};

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

Livewire.on('updateGraficoDescargaDock', (grafica, grafica2) => {
    if (descarga_dock !== null) {
        descarga_dock.destroy();
    }

    if (descarga_dock_2 !== null) {
        descarga_dock_2.destroy();
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
                y: {
                    suggestedMin: 0,
                    suggestedMax: 30,
                },
            },
            color: '#FFF',
        },
        plugins: [dock_plugin]
    });

    descarga_dock_2 = new Chart(ctx9, {
        type: "bar",
        data: grafica2,
        options: {
            animation: false,
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Dock' } }],
                y: {
                    suggestedMin: 0,
                    suggestedMax: 200,
                },
            },
            color: '#FFF',
        },
        plugins: [dock_plugin_t1]
    });
});

Livewire.on('updateGraficoDescargaMovil', (grafica, grafica2) => {
    if (descarga_movil !== null) {
        descarga_movil.destroy();
    }

    if (descarga_movil_2 !== null) {
        descarga_movil_2.destroy();
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
                y: {
                    suggestedMin: 0,
                    suggestedMax: 30,
                },
            },
            color: '#FFF',
        },
        plugins: [dock_plugin]
    });

    descarga_movil_2 = new Chart(ctx10, {
        type: "bar",
        data: grafica2,
        options: {
            animation: false,
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{ stacked: true, scaleLabel: { display: true, labelString: 'Dock' } }],
                y: {
                    suggestedMin: 0,
                    suggestedMax: 200,
                },
            },
            color: '#FFF',
        },
        plugins: [dock_plugin_t1]
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
