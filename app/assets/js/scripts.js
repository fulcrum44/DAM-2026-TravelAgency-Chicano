    // Get the modal
function abrirModalEliminacion(idViaje) {
    var modal = document.getElementById("eliminar_viaje");
    var confirmacion = document.getElementById("confirmar_eliminar");

    confirmacion.href = "../clases/eliminar_viaje.php?id=" + idViaje;

    modal.style.display = "flex";
}

function cerrarModal() {
    var modal = document.getElementById("eliminar_viaje");
    modal.style.display = "none";
}

window.onclick = function(event) {
  var modal = document.getElementById("eliminar_viaje");
  if (event.target === modal) {
    cerrarModal();
  }
};