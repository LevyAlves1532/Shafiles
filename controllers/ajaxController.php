<?php

class ajaxController extends controller
{
    public function index()
    {
    }

    public function uploadFiles()
    {
        $share = new Share();

        $array = array(
            "status" => true,
            "return" => []
        );

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if ($method === 'post') {
            if (isset($_FILES['files']) && count($_FILES['files']) > 0) {
                $files = $_FILES['files'];

                $array['return'] = $share->set($files);
            }
        } else {
            $array['status'] = false;
            $array['return'] = "A requisição deve ser 'POST'";
        }

        echo json_encode($array);
    }

    public function getCode()
    {
        $share = new Share();

        $array = array(
            "status" => true,
            "return" => []
        );

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if ($method === 'get') {
            if(!empty($_GET['code'])) {
                $code = addslashes(base64_decode($_GET['code']));

                $folder = $share->getCode($code);

                if($folder !== []) {
                    $array['return'] = $folder;
                } else {
                    $array['status'] = false;
                    $array['return'] = "Código invalido!";
                }
            }
        } else {
            $array['status'] = false;
            $array['return'] = "A requisição deve ser 'GET'";
        }

        echo json_encode($array);
    }

    public function delFilesDefault()
    {
        $share = new Share();

        $array = array(
            "status" => true,
            "return" => []
        );

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if ($method === 'get') {
            $array['return'] = $share->delDefault();

            // if($share->delDefault()) {
            //     $array['return'] = "Todos os arquivos e códigos expirados foram deletados com sucesso!";
            // }
        } else {
            $array['status'] = false;
            $array['return'] = "A requisição deve ser 'GET'";
        }

        echo json_encode($array);
    }
}
