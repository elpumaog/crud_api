<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require_once 'database.php';
    require_once 'usuario.php';

    // Conexion a la base de datos
    $database = new Database();
    $db = $database->getConnection();

    // Crear instancia de Usuario
    $usuario = new Usuario($db);

    // Obtener el metodo de la peticion
    $method = $_SERVER['REQUEST_METHOD'];

    // Manejo de peticiones
    switch ($method) {
        case 'GET':
            $stmt = $usuario->obtenerUsuarios();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($usuarios);
            break;
        
        case 'POST':
            $data = json_decode(file_get_contents("php://input"));

            if (!empty($data->nombre) && !empty($data->email)) {
                $usuario->nombre = $data->nombre;
                $usuario->email = $data->email;
                $usuario->telefono = $data->telefono;

                if ($usuario->crearUsuario()) {
                    echo json_encode(["mensaje" => "Usuario creado correctamente"]);
                } else {
                    echo json_encode(["mensaje" => "No se pudo crear el usuario"]);
                }
            } else {
                echo json_encode(["mensaje" => "Datos incompletos"]);
            }
            break;
        
        case 'PUT':
            $data = json_decode(file_get_contents("php://input"));

            if (!empty($data->id) && !empty($data->nombre) && !empty($data->email)) {
                $usuario->id = $data->id;
                $usuario->nombre = $data->nombre;
                $usuario->email = $data->email;
                $usuario->telefono = $data->telefono;

                if ($usuario->actualizarUsuario()) {
                    echo json_encode(["mensaje" => "Usuario actualizado"]);
                } else {
                    echo json_encode(["mensaje" => "No se pudo actualizar el usuario"]);
                }
            } else {
                echo json_encode(["mensaje" => "Datos incompletos"]);
            }
            break;
            
        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"));

            if(!empty($data->id)) {
                $usuario->id = $data->id;

                if ($usuario->eliminarUsuario()) {
                    echo json_encode(["mensaje" => "Usuario eliminado"]);
                } else {
                    echo json_encode(["mensaje" => "No se pudo eliminar el usuario"]);
                }
            } else {
                echo json_encode(["mensaje" => "ID no proporcionado"]);
            }
            break;
        
        default:
            echo json_encode(["mensaje" => "Metodo no permitido"]);
            break;
    }
?>