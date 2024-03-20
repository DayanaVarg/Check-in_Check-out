
document.getElementById('buttonR').addEventListener('click',
function() {
    document.querySelector('.Container-modal').style.display = 'flex';
});

document.querySelector('.closeB').addEventListener('click',
function() {
    document.querySelector('.Container-modal').style.display = 'none';
});