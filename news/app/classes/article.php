<?php

class Article
{
    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $columns = 'articles.id, articles.name, articles.description, articles.is_active, articles.updated_at, articles.created_at, articles.author_id, users.first_name, users.last_name';
        $result = $this->db->query('SELECT ' . $columns . ' FROM articles LEFT JOIN users ON articles.author_id = users.id ORDER BY articles.created_at DESC;');
        $articles = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $articles[] = $row;
        }
        return $articles;
    }

    public function get($id = 0, $column = null)
    {
        $columns = 'articles.id, articles.name, articles.description, articles.is_active, articles.updated_at, articles.created_at, articles.author_id, users.first_name, users.last_name';
        $result = $this->db->query('SELECT ' . $columns . ' FROM articles LEFT JOIN users ON articles.author_id = users.id WHERE articles.id = "' . $id . '";');
        $article = mysqli_fetch_assoc($result);
        if ($column) {
            return $article[$column];
        }
        return $article;
    }

    public function create($params = [])
    {
        $params = $this->db->postExtraction(ARTICLE_FIELDS, $params);
        $keys = array_keys($params);
        $values = array_values($params);
        $query = 'INSERT INTO articles (' . join(', ', $keys) . ', created_at, author_id) VALUES ("' .  join('", "', $values) . '", NOW(), ' . $_SESSION['user']['id'] . ');';
        $result = $this->db->query($query);
        return $result;
    }

    public function update($id, $params = [])
    {
        $params = $this->db->postExtraction(ARTICLE_FIELDS, $params);
        $set = join(', ', array_map_assoc(function($k, $v){ return $k . ' = "' . $v . '"'; }, $params));
        $query = 'UPDATE articles SET ' . $set . ', updated_at = NOW() WHERE id = ' . $this->db->fixString($id) . ';';
        $result = $this->db->query($query);
        return $result;
    }

    public function remove($id)
    {
        $query = 'DELETE FROM articles WHERE id = ' . $this->db->fixString($id) . ';';
        $result = $this->db->query($query);
        return $result;
    }

    public function getNavigation($art)
    {
        $links = [
            [
                'text' => 'DISPLAY',
                'attributes' => [
                    'href' => 'article-display.php?id=' . $art['id'],
                    'class' => 'btn btn-info',
                ],
            ],
            [
                'text' => 'UPDATE',
                'access' => 'owner',
                'attributes' => [
                    'href' => 'article-update.php?id=' . $art['id'],
                    'class' => 'btn btn-warning',
                ],
            ],
            [
                'text' => 'REMOVE',
                'access' => 'owner',
                'attributes' => [
                    'href' => 'article-remove.php?id=' . $art['id'],
                    'class' => 'btn btn-danger',
                ],
            ]
        ];

        $navigation = '';
        foreach ($links as $txt => $link) {
            $display = !preg_match('/' . preg_quote($link['attributes']['href'],'/') . '/', $_SERVER['REQUEST_URI']);
            if (isset($link['access'])) {
                switch ($link['access']) {
                    case 'owner' :
                        $display = isset($_SESSION['user']) && $art['author_id'] == $_SESSION['user']['id'];
                        break;
                }
            }
            if ($display) {
                $navigation .= '<a ' . join(' ', array_map_assoc(function($k, $v){ return $k . ' = "' . $v . '"'; }, $link['attributes'])) . '>' . $link['text'] . '</a>';
            }
        }
        return $navigation;
    }

    public function getDate($art)
    {
        $date = 'Created: <i>' . $art['created_at'] . '</i>';
        if ($art['created_at'] !== $art['updated_at']) {
            $date .= ' | Updated: <i>' . $art['updated_at'] . '</i>';
        }
        return $date;
    }
}