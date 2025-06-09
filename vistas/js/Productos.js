let productosTodos = [];
let productosFiltrados = [];
let paginaActual = 1;

const POR_PAGINA = 9;

function cargarProductos(){
    fetch('..ajax/Productos.php')
    .then(res => res.json())
    .then(productos => {
        productosTodos = productos;
        productosFiltrados = productos;
        renderProductos();
        agregarListeners();
    })
    .catch(err => console.error('Error al cargar productos: ', err))
}

function agregarListeners(){
    const searchInput = document.getElementById('search-input');
    
    if(searchInput) searchInput.addEventListener('input', aplicarFiltros);
        document.querySelectorAll('[id^="price-"]').forEach(cb => {
            cb.addEventListener('change', aplicarFiltros);
        });
}

function aplicarFiltros(){
    const search = document.getElementById('search-input')?.value.toLowerCase()||'';
    const precios = Array.from(document.querySelectorAll('[id^="price-"]:checked')).map(c => c.id);

    clone.querySelector('.product-img').src = `../assets/img/product-${pid_producto % 9 + 1}.jpg`;
    clone.querySelector();
    clone.querySelector();
    clone.querySelector();
    clone.querySelector();
    clone.querySelector();
    clone.querySelector();
    clone.querySelector();
}