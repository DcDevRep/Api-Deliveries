<?php
  /****************************************
     *todo Petición PUT.
     ****************************************/
      /********************************************
       *! Requerimientos.
      ********************************************/
        require_once "models/connection.php";
        require_once "controllers/router.controller.php";
      /********************************************
       *! Header.
      ********************************************/
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, content-type: application/json; charset=utf-8, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
      /*******************************
       ** Api Deliveries
      ********************************/
        $arrayRouters = explode("/", $_SERVER['REQUEST_URI']);
        $arrayRouters = array_filter($arrayRouters);
        date_default_timezone_set('America/Guayaquil');
        $return = new RouterController();
      /********************************
       ** No hay Petición en la api
      ********************************/
        if (count($arrayRouters) < 1 || count($arrayRouters) >1) {
          $return->fncResponse(null,"Router",null);
          return;
        }
      /********************************
       ** Petición en la api
      ********************************/
        if (count($arrayRouters) == 1 && isset($_SERVER['REQUEST_METHOD'])){
          /********************************
           *? Set table
          ********************************/
            $table=explode("?",$arrayRouters[1])[0];
          /********************************
           *? Validación de la Api Key
          ********************************/
            if (!isset(getallheaders()["Authorization"]) ||
                getallheaders()["Authorization"] != Connection::apiKey()) {
                  $return->fncResponse(null,"Router","You are not authorized to make this request...");
                  return;
            }
          /*************************************
           *? Set DB
          ** 1 -> Sql-local
          ** 2 -> Sql-Heroku
          ** 3 -> PgSql-local
          ** 4 -> PgSql-Heroku
          *************************************/
            $db=2;
          /********************************
           ** Petición GET
          ********************************/
            if ($_SERVER['REQUEST_METHOD']=='GET'){
              include "services/get.php";
            }
          /*******************************
           ** Petición POST
          ********************************/
            if ($_SERVER['REQUEST_METHOD']=='POST'){
              include "services/post.php";
            }
          /********************************
           ** Petición PUT
          ********************************/
            if ($_SERVER['REQUEST_METHOD']=='PUT'){
              include "services/put.php";
            }
          /********************************
           ** Petición DELETE
          ********************************/
            if ($_SERVER['REQUEST_METHOD']=='DELETE'){
              include "services/delete.php";
            }
        }
?>