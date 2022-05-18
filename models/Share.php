<?php

class Share extends model
{

    public function get($id)
    {
        $array = [];

        $sql = "SELECT * FROM share WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function getCode($code)
    {
        $array = [];

        $sql = "SELECT * FROM share WHERE code = :code";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':code', $code);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);

            $sql = "SELECT * FROM files WHERE id_share = :id_share";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id_share', $array['id']);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $array['files'] = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        return $array;
    }

    public function set($files)
    {
        $code = md5(time());
        $folder_name = md5(date('Y-m-d H:i:s'));
        mkdir('assets/img/' . $folder_name);

        $sql = "INSERT INTO share SET code = :code, url = :url, expires = :expires";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':code', $code);
        $sql->bindValue(':url', $folder_name);
        $sql->bindValue(':expires', date('Y-m-d H:i:s', strtotime('+5 minutes')));
        $sql->execute();

        $last_id_share = $this->db->lastInsertId();

        for ($x = 0; $x < count($files['tmp_name']); $x++) {
            if (
                $files['type'][$x] === 'image/jpeg' ||
                $files['type'][$x] === 'image/jpg' ||
                $files['type'][$x] === 'image/png' ||
                $files['type'][$x] === 'video/mp4'
            ) {
                $sql = "INSERT INTO files SET id_share = :id_share, file_name = :file_name, size = :size";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':id_share', $last_id_share);
                $sql->bindValue(':file_name', $files['name'][$x]);
                $sql->bindValue(':size', $files['size'][$x]);
                $sql->execute();

                move_uploaded_file($files['tmp_name'][$x], 'assets/img/' . $folder_name . '/' . $files['name'][$x]);
            }
        }

        return $code;
    }

    public function delDefault()
    {
        $sql = "SELECT * FROM share WHERE expires < :expires";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':expires', date('Y-m-d H:i:s'));
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($sql as $share) {
                if (file_exists('assets/img/' . $share['url'])) {
                    $sql =  "SELECT * FROM files WHERE id_share = :id_share";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(':id_share', $share['id']);
                    $sql->execute();

                    if ($sql->rowCount() > 0) {
                        $sql = $sql->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($sql as $files) {
                            if (file_exists('assets/img/' . $share['url'] . '/' . $files['file_name'])) {
                                unlink('assets/img/' . $share['url'] . '/' . $files['file_name']);
                            }
                        }

                        $sql = "DELETE FROM files WHERE id_share = :id_share";
                        $sql = $this->db->prepare($sql);
                        $sql->bindValue(':id_share', $share['id']);
                        $sql->execute();
                    }
                }

                $sql = "DELETE FROM share WHERE id = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':id', $share['id']);
                $sql->execute();

                rmdir('assets/img/'.$share['url']);
            }

            return true;
        } else {
            return false;
        }
    }
}
