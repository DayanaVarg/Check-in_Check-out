document.getElementById("exportButton").addEventListener("click", function() {
    var table = document.getElementById("datat");
    var clonedTable = table.cloneNode(true);
    clonedTable.querySelectorAll("#act1").forEach(cell => cell.remove());
    clonedTable.querySelectorAll("#act").forEach(cell => cell.remove());
    var html = clonedTable.outerHTML;
    var a = document.createElement('a');
    a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
    a.download = 'visitantesInactivos.xls';
    a.click();
});