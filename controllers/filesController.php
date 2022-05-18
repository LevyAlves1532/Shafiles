<?php

class filesController extends controller
{

    public function index()
    {
        $data = [];

        if(!empty($_GET['code'])) {
            $data['code'] = addslashes($_GET['code']);
        } else {
            header('Location: '.BASE);
            exit;
        }

        $this->loadTemplate('files', $data);
    }
}
