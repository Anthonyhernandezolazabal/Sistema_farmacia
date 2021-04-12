$(document).ready(function () {
  let funcion;
  venta_mes();
  vendedor_mes();
  ventas_anual();
  producto_mas_vendido();
  cliente_mes();
  /*============================
    CONSULTAS 5 PRODUCTOS DEL MES
    =============================*/
  async function producto_mas_vendido() {
    funcion = "producto_mas_vendido";
    let lista = ["", "", "", "", ""];
    const response = await fetch("controlador/VentaController.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "funcion=" + funcion,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (productos) {
        let i = 0;
        productos.forEach((producto) => {
          lista[i] = producto;
          i++;
        });
      });
    let CanvasG4 = $("#grafico4").get(0).getContext("2d");
    let datos = {
      labels: ["Mes actual"],
      datasets: [
        {
          label: lista[0].nombre + lista[0].concentracion + lista[0].adicional,
          backgroundColor: "rgba(60,141,188,0.9)",
          borderColor: "rgba(60,141,188,0.8)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [lista[0].total],
        },
        {
          label: lista[1].nombre + lista[1].concentracion + lista[1].adicional,
          backgroundColor: "rgba(0,0,255,0.1)",
          borderColor: "rgba(0,0,255,0.1)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(0,0,255,0.1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(0,0,255,0.1)",
          data: [lista[1].total],
        },
        {
          label: lista[2].nombre + lista[2].concentracion + lista[2].adicional,
          backgroundColor: "rgba(0,255,0,1)",
          borderColor: "rgba(0,255,0,1)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(0,255,0,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(0,255,0,1)",
          data: [lista[2].total],
        },
        {
          label: lista[3].nombre + lista[3].concentracion + lista[3].adicional,
          backgroundColor: "rgba(255,255,0,0.1)",
          borderColor: "rgba(255,255,0,0.1)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(255,255,0,0.1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(255,255,0,0.1)",
          data: [lista[3].total],
        },
        {
          label: lista[4].nombre + lista[4].concentracion + lista[4].adicional,
          backgroundColor: "rgba(255,0,0,0.1)",
          borderColor: "rgba(255,0,0,0.1)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(255,0,0,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(255,0,0,1)",
          data: [lista[4].total],
        },
      ],
    };
    let opciones = {
      maintainAspectRatio: false,
      responsive: true,
      datasetFill: false,
    };
    var G4 = new Chart(CanvasG4, {
      type: "bar",
      data: datos,
      options: opciones,
    });
  }
  /*============================
    DATOS DEL LOS AÑOS ANTERIOR
    =============================*/
  async function ventas_anual() {
    funcion = "ventas_anual";
    let lista = ["", "", "", "", "", "", "", "", "", "", "", ""];
    const response = await fetch("controlador/VentaController.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "funcion=" + funcion,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (meses_anio) {
        meses_anio.forEach((mes) => {
          if (mes.mes == 1) {
            //Enero
            lista[0] = mes;
          }
          if (mes.mes == 2) {
            //Enero
            lista[1] = mes;
          }
          if (mes.mes == 3) {
            //Enero
            lista[2] = mes;
          }
          if (mes.mes == 4) {
            //Enero
            lista[3] = mes;
          }
          if (mes.mes == 5) {
            //Enero
            lista[4] = mes;
          }
          if (mes.mes == 6) {
            //Enero
            lista[5] = mes;
          }
          if (mes.mes == 7) {
            //Enero
            lista[6] = mes;
          }
          if (mes.mes == 8) {
            //Enero
            lista[7] = mes;
          }
          if (mes.mes == 9) {
            //Enero
            lista[8] = mes;
          }
          if (mes.mes == 10) {
            //Enero
            lista[9] = mes;
          }
          if (mes.mes == 11) {
            //Enero
            lista[10] = mes;
          }
          if (mes.mes == 12) {
            //Enero
            lista[11] = mes;
          }
        });
      });
    funcion = "venta_mes";
    let lista1 = ["", "", "", "", "", "", "", "", "", "", "", ""];
    const response1 = await fetch("controlador/VentaController.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "funcion=" + funcion,
    })
      .then(function (response1) {
        return response1.json();
      })
      .then(function (meses_anio_actual) {
        meses_anio_actual.forEach((mes) => {
          if (mes.mes == 1) {
            //Enero
            lista1[0] = mes;
          }
          if (mes.mes == 2) {
            //Enero
            lista1[1] = mes;
          }
          if (mes.mes == 3) {
            //Enero
            lista1[2] = mes;
          }
          if (mes.mes == 4) {
            //Enero
            lista1[3] = mes;
          }
          if (mes.mes == 5) {
            //Enero
            lista1[4] = mes;
          }
          if (mes.mes == 6) {
            //Enero
            lista1[5] = mes;
          }
          if (mes.mes == 7) {
            //Enero
            lista1[6] = mes;
          }
          if (mes.mes == 8) {
            //Enero
            lista1[7] = mes;
          }
          if (mes.mes == 9) {
            //Enero
            lista1[8] = mes;
          }
          if (mes.mes == 10) {
            //Enero
            lista1[9] = mes;
          }
          if (mes.mes == 11) {
            //Enero
            lista1[10] = mes;
          }
          if (mes.mes == 12) {
            //Enero
            lista1[11] = mes;
          }
        });
      });
    let CanvasG3 = $("#grafico3").get(0).getContext("2d");
    let datos = {
      labels: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agost",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
      ],
      datasets: [
        {
          label: "Año Actual",
          backgroundColor: "rgba(60,141,188,0.9)",
          borderColor: "rgba(60,141,188,0.8)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [
            lista1[0].cantidad,
            lista1[1].cantidad,
            lista1[2].cantidad,
            lista1[3].cantidad,
            lista1[4].cantidad,
            lista1[5].cantidad,
            lista1[6].cantidad,
            lista1[7].cantidad,
            lista1[8].cantidad,
            lista1[9].cantidad,
            lista1[10].cantidad,
            lista1[11].cantidad,
          ],
        },
        {
          label: "Año Anterior",
          backgroundColor: "rgba(210,214,222,1)",
          borderColor: "rgba(210,214,222,1)",
          pointRadius: false,
          pointColor: "#c1c7d1",
          pointStrokeColor: "rgba(210,214,222,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(210,214,222,1)",
          data: [
            lista[0].cantidad,
            lista[1].cantidad,
            lista[2].cantidad,
            lista[3].cantidad,
            lista[4].cantidad,
            lista[5].cantidad,
            lista[6].cantidad,
            lista[7].cantidad,
            lista[8].cantidad,
            lista[9].cantidad,
            lista[10].cantidad,
            lista[11].cantidad,
          ],
        },
      ],
    };
    let opciones = {
      maintainAspectRatio: false,
      responsive: true,
      datasetFill: false,
    };
    var G3 = new Chart(CanvasG3, {
      type: "bar",
      data: datos,
      options: opciones,
    });
  }
  /*============================
    CONSULTAS 3 PRIMEROS CLIENTES
    =============================*/
  async function cliente_mes() {
    funcion = "cliente_mes";
    let lista = ["", "", ""];
    const response = await fetch("controlador/VentaController.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "funcion=" + funcion,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (clientes) {
        let i = 0;
        clientes.forEach((cliente) => {
          lista[i] = cliente;
          i++;
        });
      });
    let CanvasG5 = $("#grafico5").get(0).getContext("2d");
    let datos = {
      labels: ["Mes actual"],
      datasets: [
        {
          label: lista[0].cliente_nombre,
          backgroundColor: "rgba(0,255,0,1)",
          borderColor: "rgba(0,255,0,1)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(0,255,0,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(0,255,0,1)",
          data: [lista[0].cantidad],
        },
        {
          label: lista[1].cliente_nombre,
          backgroundColor: "rgba(255,0,0,0.1)",
          borderColor: "rgba(255,0,0,0.1)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(255,0,0,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(255,0,0,1)",
          data: [lista[1].cantidad],
        },
        {
          label: lista[2].cliente_nombre,
          backgroundColor: "rgba(60,141,188,0.9)",
          borderColor: "rgba(60,141,188,0.8)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [lista[2].cantidad],
        },
      ],
    };
    let opciones = {
      maintainAspectRatio: false,
      responsive: true,
      datasetFill: false,
    };
    var G2 = new Chart(CanvasG5, {
      type: "bar",
      data: datos,
      options: opciones,
    });
  }
  /*============================
    CONSULTAS 3 PRIMEROS VENDEDORES
    =============================*/
  async function vendedor_mes() {
    funcion = "vendedor_mes";
    let lista = ["", "", ""];
    const response = await fetch("controlador/VentaController.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "funcion=" + funcion,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (vendedores) {
        let i = 0;
        vendedores.forEach((vendedor) => {
          lista[i] = vendedor;
          i++;
        });
      });
    let CanvasG2 = $("#grafico2").get(0).getContext("2d");
    let datos = {
      labels: ["Mes actual"],
      datasets: [
        {
          label: lista[0].vendedor_nombre,
          backgroundColor: "rgba(60,141,188,0.9)",
          borderColor: "rgba(60,141,188,0.8)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [lista[0].cantidad],
        },
        {
          label: lista[1].vendedor_nombre,
          backgroundColor: "rgba(255,0,0,0.1)",
          borderColor: "rgba(255,0,0,0.1)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(255,0,0,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(255,0,0,1)",
          data: [lista[1].cantidad],
        },
        {
          label: lista[2].vendedor_nombre,
          backgroundColor: "rgba(0,255,0,1)",
          borderColor: "rgba(0,255,0,1)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(0,255,0,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(0,255,0,1)",
          data: [lista[2].cantidad],
        },
      ],
    };
    let opciones = {
      maintainAspectRatio: false,
      responsive: true,
      datasetFill: false,
    };
    var G2 = new Chart(CanvasG2, {
      type: "bar",
      data: datos,
      options: opciones,
    });
  }

  /*============================
    CONSULTAS VENTAS POR MES DEL AÑO
    =============================*/
  async function venta_mes() {
    funcion = "venta_mes";
    let array = ["", "", "", "", "", "", "", "", "", "", "", ""];
    const response = await fetch("controlador/VentaController.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "funcion=" + funcion,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (meses) {
        meses.forEach((mes) => {
          if (mes.mes == 1) {
            //Enero
            array[0] = mes;
          }
          if (mes.mes == 2) {
            //Enero
            array[1] = mes;
          }
          if (mes.mes == 3) {
            //Enero
            array[2] = mes;
          }
          if (mes.mes == 4) {
            //Enero
            array[3] = mes;
          }
          if (mes.mes == 5) {
            //Enero
            array[4] = mes;
          }
          if (mes.mes == 6) {
            //Enero
            array[5] = mes;
          }
          if (mes.mes == 7) {
            //Enero
            array[6] = mes;
          }
          if (mes.mes == 8) {
            //Enero
            array[7] = mes;
          }
          if (mes.mes == 9) {
            //Enero
            array[8] = mes;
          }
          if (mes.mes == 10) {
            //Enero
            array[9] = mes;
          }
          if (mes.mes == 11) {
            //Enero
            array[10] = mes;
          }
          if (mes.mes == 12) {
            //Enero
            array[11] = mes;
          }
        });
      });
    /* GRAFICO */
    let CanvasG1 = $("#grafico1").get(0).getContext("2d");
    let datos = {
      labels: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agost",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
      ],
      datasets: [
        {
          data: [
            array[0].cantidad,
            array[1].cantidad,
            array[2].cantidad,
            array[3].cantidad,
            array[4].cantidad,
            array[5].cantidad,
            array[6].cantidad,
            array[7].cantidad,
            array[8].cantidad,
            array[9].cantidad,
            array[10].cantidad,
            array[11].cantidad,
          ],
          backgroundColor: [
            "#FF00F0",
            "#0CFF00",
            "#f56954",
            "#F7FF00",
            "#f39c12",
            "#d2d6de",
            "#FF8F00",
            "#3c8dbc",
            "#000000",
            "#00c0ef",
            "#108504",
          ],
        },
      ],
    };
    let opciones = {
      maintainAspectRatio: false,
      responsive: true,
    };
    var G1 = new Chart(CanvasG1, {
      type: "pie",
      data: datos,
      options: opciones,
    });
  }
});
