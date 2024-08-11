function cargarContenido(abrir) {

    var contenido = document.getElementById('contenido');

    fetch(abrir)
      .then((response) => response.text())
      .then((data) => {
        contenido.innerHTML = data;
    });
}