const apiUrl = "http://localhost/crud_api/api/api.php";

// Obtener usuarios desde la API
async function obtenerUsuarios() {
    try {
        const response = await fetch(`${apiUrl}?action=read`);
        const textResponse = await response.text();
        console.log('Respuesta de la API: ', textResponse);
        const usuarios = JSON.parse(textResponse);

        if (Array.isArray(usuarios) && usuarios.length > 0) {
            mostrarUsuarios(usuarios);
        } else {
            console.log("No se encontraron usuarios.");
        }
    } catch (error) {
        console.error("Error al obtener los usuarios: ", error);
    }
}

// Mostrar los usuarios en la lista
function mostrarUsuarios(usuarios) {
    const usuariosList = document.getElementById('usuarios');
    usuariosList.innerHTML = '';    // Limpiar la lista actual
    usuarios.forEach(usuario => {
        const li = document.createElement('li');
        li.innerHTML = `${usuario.nombre} - ${usuario.email} - ${usuario.telefono} <button onclick="eliminarUsuario(${usuario.id})">Eliminar</button><button onclick="editarUsuario(${usuario.id})">Editar</button>`;
        usuariosList.appendChild(li);
    })
}

// Agregar o actualizar usuario
document.getElementById('usuarioForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const id = document.getElementById('id').value;
    const nombre = document.getElementById('nombre').value;
    const email = document.getElementById('email').value;
    const telefono = document.getElementById('telefono').value;

    const usuario = { nombre, email, telefono };

    let url = apiUrl;
    let method = 'POST';

    if (id) {
        url += `?action=update&id=${id}`;
        method = 'PUT';
        usuario.id = id;
    }

    const response = await fetch(url, {
        method,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(usuario),
    });

    await response.json();
    obtenerUsuarios();  // Refrescar la lista de usuarios
    document.getElementById('usuarioForm').reset();
    document.getElementById('id').value = '';   // Limpiar el id
});

// Eliminar un usuario
async function eliminarUsuario(id) {
    const response = await fetch(`${apiUrl}?action=delete`, {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
    });
    const result = await response.json();
    alert(result.mensaje);  // Mostrar mensaje de exito o error
    obtenerUsuarios();  // Refrescar la lista de usuarioss
}

// Editar un usuario
function editarUsuario(id) {
    const usuario = document.querySelector(`#usuariosList li[data-id="${id}"]`);
    const nombre = document.querySelector('.nombre').textContent;
    const email = document.querySelector('.email').textContent;
    const telefono = document.querySelector('.telefono').textContent;

    document.getElementById('id').value = id;
    document.getElementById('nombre').value = nombre;
    document.getElementById('email').value = email;
    document.getElementById('telefono').value = telefono;
}

obtenerUsuarios();