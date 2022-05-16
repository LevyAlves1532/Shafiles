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
            $array['return'] = "A requisição deve ser 'GET'";
        }

        echo json_encode($array);
    }
}
