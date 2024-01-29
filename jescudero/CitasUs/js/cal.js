function setfecha(indicador) {
  fecha_sel = indicador;
  document.getElementById("fecha_reserva").value = fecha_sel;
}
function setfecha_prev(indicador) {
  fecha_sel = indicador;
  document.getElementById("fecha_reserva").value = fecha_sel;
  document.getElementById("fecha_reserva_prev").value = fecha_sel;
}
function limpiarFormulario() {
  document.getElementById("formulario2").reset();
}
function limpiarTramos() {
  document.getElementById("formulario_tramos").reset();
}
function limpiarFormulario() {
  document.getElementById("formulario2").reset();
}
function settramo(numero) {
  tramo_sel = numero;
  document.getElementById("tramo_sel").value = tramo_sel;
}
function settramo_prev(numero) {
  tramo_sel = numero;
  document.getElementById("tramo_sel").value = tramo_sel;
  document.getElementById("tramo_sel_prev").value = tramo_sel;
}
function setInicio(hora){
  prueba = hora;
  document.getElementById("hora_inicio").value = prueba;
}
function setFinal(hora){
  prueba = hora;
  document.getElementById("hora_fin").value = prueba;
}
function setHoraInicio(hora) {
  prueba = hora;
  document.getElementById("inicio").value = prueba;
}
function setHoraFin(hora) {
  prueba = hora;
  document.getElementById("final").value = prueba;
}
function setNumero(num) {
  prueba = num;
  document.getElementById("numero").value = prueba;
}
function setcomentario(adest) {
  comentario_sel = adest;
  document.getElementById("comentario").value = comentario_sel;
}
function setcomentario_prev(adest) {
  comentario_sel = adest;
  document.getElementById("comentario").value = comentario_sel;
  document.getElementById("comentario_prev").value = comentario_sel;
}
function setnombre(qwert) {
  nombre = qwert;
  document.getElementById("nombre").value = nombre;
}
function setnombre_prev(qwert) {
  nombre = qwert;
  document.getElementById("nombre").value = nombre;
  document.getElementById("nombre_prev").value = nombre;
}
function fechaactual(fecha_hoy) {
  prueba = fecha_hoy;
  document.getElementById("fecha").value = prueba;
}
function fechaactual_prev(fecha_hoy) {
  prueba = fecha_hoy;
  document.getElementById("fecha").value = prueba;
  document.getElementById("fecha_prev").value = prueba;
}

function setdisponibilidad(valor) {
  switch (valor) {
    case "0":
      document.getElementById("anular").setAttribute("selected", "selected");
      document.getElementById("reservar").removeAttribute("selected");
      break;
    case "1":
      document.getElementById("reservar").setAttribute("selected", "selected");
      document.getElementById("anular").removeAttribute("selected");
      break;
  }
}

function deshabilitardia(dia) {}

function alert($msg) {
  alert("$msg");
}
