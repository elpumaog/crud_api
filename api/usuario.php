<?php
    require_once 'database.php';

    class Usuario {
        private $conn;
        private $table_name = "usuarios";

        public $id;
        public $nombre;
        public $email;
        public $telefono;
        public $creado_en;

        public function __construct($db) {
            $this->conn = $db;
        }

        // Metodo para obtener todos los usuarios
        public function obtenerUsuarios() {
            $query = "SELECT id, nombre, email, telefono, creado_en FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;

            // Sanitizar datos
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->telefono = htmlspecialchars(strip_tags($this->telefono));

            // Bind de parametros
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":telefono", $this->telefono);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        // Metodo para crear un usuario
        public function crearUsuario() {
            $query = "INSERT INTO " . $this->table_name . " (nombre, email, telefono) VALUES (:nombre, :email, :telefono)";
            $stmt = $this->conn->prepare($query);

            // Sanitizar datos
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->telefono = htmlspecialchars(strip_tags($this->telefono));

            // Bind de parametros
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":telefono", $this->telefono);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        // Metodo para actualizar el usuario
        public function actualizarUsuario() {
            $query = "UPDATE usuarios SET nombre = :nombre, email = :email, telefono = :telefono WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            // Bind de parametros
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":telefono", $telefono);
            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        // Metodo para eliminar un usuario
        public function eliminarUsuario() {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            // Sanitizar datos
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind de parametros
            $stmt->bindParam(":id", $this->id);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
    }
?>