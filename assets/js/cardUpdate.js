document.getElementById('imagenInput').addEventListener('change', function(event) {
    var archivo = event.target.files[0];
    var lector = new FileReader();

    lector.onload = function(e) {
        var imagenPrevia = document.getElementById('imagenPrevia');
        imagenPrevia.src = e.target.result;
        imagenPrevia.style.display = 'block';
    };

    lector.readAsDataURL(archivo);
});

function loadinput(){
    document.getElementById('load').style.opacity = 100;
    document.getElementById('btnl').style.display  = 'none';
    document.getElementById('btnC').style.display  = 'block';
    document.getElementById('pho').style.display = 'none';
}

function closeinput(){
    document.getElementById('load').style.opacity = 0;
    document.getElementById('btnl').style.display  = 'block';
    document.getElementById('btnC').style.display  = 'none';
    document.getElementById('pho').style.display = 'block';
}
function limpiarImagen() {
    document.getElementById('imagenInput').value = ''; 
    document.getElementById('imagenPrevia').src = '#'; 
    document.getElementById('imagenPrevia').style.display = 'none'; 
    
}
