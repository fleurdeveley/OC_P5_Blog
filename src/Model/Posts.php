<?php

namespace Blog\Model;

use DateTime;
use Exception;

class Post extends Model
{
    private $id;
    private $category_id;
    private $user_id;
    private $title;
    private $chapo;
    private $content;
    private $created_at;
    private $picture;
    private $updated_at;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }
    public function setCategoryId($category_id)
    {
        $this->category_id = (int) $category_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
    public function setUserId($user_id)
    {
        $this->user_id = (int)$user_id;
    }

    public function getTitle()
    {
        return $this->title;
    }
        public function setTitle($title)
    {
        if (is_string($title)) {
            $this->title = htmlspecialchars($title);
        }
    }

    public function getChapo()
    {
        return $this->chapo;
    }
    public function setChapo($chapo)
    {
        if (is_string($chapo)) {
            $this->chapo = nl2br(htmlspecialchars($chapo));
        }
    }

    public function getContent()
    {
        return $this->content;
    }
        public function setContent($content)
    {
        if (is_string($content)) {
            $this->content = nl2br(htmlspecialchars($content));
        }
    }

    public function getCreatedAt($format = 'd-m-Y H:i:s')
    {
        return $this->created_at->format($format);
    }
        public function setCreatedAt($created_at)
    {
        if ($this->validateDate($created_at)) {
            $this->created_at = new DateTime($created_at);
        } else {
            throw new Exception ('Date invalide !');
        }
    }

    public function getPicture()
    {
        return $this->picture;
    }
    public function setPicture($picture)
    {
        if (is_string($picture)) {
            $this->picture = $picture;
        }
    }

    public function getUpdatedAt($format = 'd-m-Y H:i:s')
    {
        return $this->updated_at->format($format);
    }
        public function setUpdatedAt($updated_at)
    {
        if ($this->validateDate($updated_at)) {
            $this->updated_at = new DateTime($updated_at);
        } else {
            throw new Exception ('Date invalide !');
        }
    }
}