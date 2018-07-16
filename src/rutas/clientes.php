<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// GET clientes

$app->get('/api/clientes', function(Request $req, Response $res){
    $consulta = 'SELECT * FROM clientes';

    try{
        // instancia DB
        $db = new Db();
        // conexion
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $clientes = $ejecutar->fetchall(PDO::FETCH_OBJ);
        $db = null;


        // Exportar en formato Json
        echo json_encode($clientes);

    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// GET cliente ID

$app->get('/api/clientes/{id}', function(Request $req, Response $res){
    
    $id = $req->getAttribute('id');
    
    $consulta = "SELECT * FROM clientes WHERE id = $id";

    try{
        // instancia DB
        $db = new Db();
        // conexion
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $clientes = $ejecutar->fetchall(PDO::FETCH_OBJ);
        $db = null;


        // Exportar en formato Json
        echo json_encode($clientes);

    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// POST nuevo cliente

$app->post('/api/clientes', function(Request $req, Response $res){
    
    $nombre = $req->getParam('nombre');
    $apellido = $req->getParam('apellido');
    $telefono = $req->getParam('telefono');
    $email = $req->getParam('email');
    $direccion = $req->getParam('direccion');
    $ciudad = $req->getParam('ciudad');
    $departamento = $req->getParam('departamento');
    
    $consulta = "INSERT INTO clientes (nombre, apellido, telefono, email, direccion, ciudad, departamento) VALUES(
        :nombre, :apellido, :telefono, :email, :direccion, :ciudad, :departamento)";

    try{
        // instancia DB
        $db = new Db();
        // conexion
        $db = $db->conectar();
        $stmt = $db->prepare($consulta);
        $stmt->bindParam(':nombre',$nombre);
        $stmt->bindParam(':apellido',$apellido);
        $stmt->bindParam(':telefono',$telefono);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':direccion',$direccion);
        $stmt->bindParam(':ciudad',$ciudad);
        $stmt->bindParam(':departamento',$departamento);
        $stmt->execute();

        echo '{"ok": {"text": "cliente agregado"}}';

        $db = null;

    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// PUT actualizar cliente

$app->put('/api/clientes/{id}', function(Request $req, Response $res){
    
    $id = $req->getAttribute('id');
    
    $nombre = $req->getParam('nombre');
    $apellido = $req->getParam('apellido');
    $telefono = $req->getParam('telefono');
    $email = $req->getParam('email');
    $direccion = $req->getParam('direccion');
    $ciudad = $req->getParam('ciudad');
    $departamento = $req->getParam('departamento');
    
    $consulta = "UPDATE clientes SET 
        nombre = :nombre,
        apellido = :apellido,
        telefono = :telefono,
        email = :email,
        direccion = :direccion,
        ciudad = :ciudad,
        departamento = :departamento
        WHERE id = $id";

    try{
        // instancia DB
        $db = new Db();
        // conexion
        $db = $db->conectar();
        $stmt = $db->prepare($consulta);
        $stmt->bindParam(':nombre',$nombre);
        $stmt->bindParam(':apellido',$apellido);
        $stmt->bindParam(':telefono',$telefono);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':direccion',$direccion);
        $stmt->bindParam(':ciudad',$ciudad);
        $stmt->bindParam(':departamento',$departamento);
        $stmt->execute();

        echo '{"ok": {"text": "cliente actualizado"}}';

        $db = null;

    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// DELETE cliente ID

$app->delete('/api/clientes/{id}', function(Request $req, Response $res){
    
    $id = $req->getAttribute('id');
    
    $consulta = "DELETE FROM clientes WHERE id = $id";

    try{
        // instancia DB
        $db = new Db();
        // conexion
        $db = $db->conectar();
        $stmt = $db->prepare($consulta);
        $stmt->execute();
        $db = null;

        echo '{"ok": {"text": "cliente eliminado"}}';

    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

