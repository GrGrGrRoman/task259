<?php

namespace App\models;

use App\core\Model;
use function App\d;

class Main extends Model
{
    public function postsCount()
    {
		return $this->db->column('SELECT COUNT(id) FROM images');
	  }

    public function postsList($route) 
    {
		$max = 1;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
		];
		return $this->db->row('SELECT * FROM images ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function isPostExists($id)
    {
        $params = 
        [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM images WHERE id = :id', $params);
    }

    // удаление изображения с комментариями
    public function imageDelete($id)
    {
        $params =
        [
            'id' => $id,
        ];
        $this->db->query('DELETE FROM images WHERE id = :id', $params);
        $this->db->query('DELETE FROM comments WHERE id_img = :id', $params);
        unlink(UPLOAD_DIR . DIRECTORY_SEPARATOR . $id . '.jpg');
    }

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

    // добавление комментария
    public function postAdd($post, $author)
    {
        $params =
        [
            'id_img' => $post['id_img'],
            'post' => $post['post'],
            'author' => $author,
            'date' => date('d.m.Y h:i:s'),
        ];

        $this->db->query('INSERT INTO comments (id_img, post, author, date) VALUES (:id_img, :post, :author, :date)', $params);
    }
}