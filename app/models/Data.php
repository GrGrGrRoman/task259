<?php

namespace App\models;

use App\core\Model;
use function App\d;

class Data extends Model
{
    public function postValidate($post)
    {
        $textValidation = iconv_strlen($post['post']);

        if ($textValidation < 1 or $textValidation > 200)
        {
            echo 'Текст должен содержать до 200 символов' . PHP_EOL;
            return false;
        }
        return true;
    }

    public function imageValidate()
    {
        if (empty($_FILES['img']['tmp_name']))
        {
            echo 'Загрузите изображение';
            return false;
        }
                
        if ($_FILES['img']['size'] > MAX_FILE_SIZE)
        {
            echo 'Недопустимый размер файла';
            return false;
        }

        if (!in_array($_FILES['img']['type'], ALLOWED_TYPES)) {
            echo 'Недопустимый формат файла ';
            return false;
        }
        return true;
    }

    public function postAdd($id, $post, $author)
    {
        $params =
        [
            'id_img' => $id,
            'post' => $post['post'],
            'author' => $author,
            'date' => date('d.m.Y h:i:s'),
        ];

        $this->db->query('INSERT INTO comments (id_img, post, author, date) VALUES (:id_img, :post, :author, :date)', $params);
    }

    public function postAddImg($owner)
    {
        $params =
        [
            'owner' => $owner,
            'date' => date('d-m-y'),
        ];

        $this->db->query('INSERT INTO images (owner, date) VALUES (:owner, :date)', $params);
        return $this->db->lastInsertId();
    }

    // удаление комментария
    public function commentDelete($id)
    {
        $params =
        [
            'id' => $id,
        ];
        $this->db->query('DELETE FROM comments WHERE id = :id', $params);
    }

    public function postUploadImage($path, $file)
    {
        move_uploaded_file($path, UPLOAD_DIR . DIRECTORY_SEPARATOR . $file . '.jpg');
    }

    public function isPostExists($id)
    {
        $params = 
        [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM images WHERE id = :id', $params);
    }

    public function isCommentExists($id)
    {
        $params = 
        [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM comments WHERE id = :id', $params);
    }

    public function postData($id)
    {
        $params = 
        [
            'id' => $id,
        ];

        return $this->db->row('SELECT * FROM images WHERE id = :id', $params);
    }

    public function postsCount()
    {
		return $this->db->column('SELECT COUNT(id) FROM images');
	}

    public function commentsList() 
    {
      $params = 
      [
          'id_img' => $_COOKIE['id_img'],
      ];
		return $this->db->row('SELECT * FROM comments WHERE id_img = :id_img ORDER BY id DESC', $params);
    }

}