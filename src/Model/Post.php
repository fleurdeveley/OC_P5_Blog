<?php

namespace Blog\Model;

use DateTime;
use Exception;

/**
 * Class Post
 */

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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = (int) $category_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = (int) $user_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->title = htmlspecialchars($title);
        }
    }

    /**
     * @return string
     */
    public function getChapo(): string
    {
        return $this->chapo;
    }

    /**
     * @param $chapo
     */
    public function setChapo($chapo)
    {
        if (is_string($chapo)) {
            $this->chapo = nl2br(htmlspecialchars($chapo));
        }
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param $content
     */
    public function setContent($content)
    {
        if (is_string($content)) {
            $this->content = $content;
        }
    }

    /**
     * @param string $format
     * @return string
     */
    public function getCreatedAt($format = 'd-m-Y H:i:s'): string
    {
        return $this->created_at->format($format);
    }

    /**
     * @param $created_at
     * @throws Exception
     */
    public function setCreatedAt($created_at)
    {
        if ($this->validateDate($created_at)) {
            $this->created_at = new DateTime($created_at);
        } else {
            throw new Exception ('Date invalide !');
        }
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param $picture
     */
    public function setPicture($picture)
    {
        if (is_string($picture)) {
            $this->picture = $picture;
        }
    }

    /**
     * @param string $format
     * @return string
     */
    public function getUpdatedAt($format = 'd-m-Y H:i:s'): string
    {
        return $this->updated_at->format($format);
    }

    /**
     * @param $updated_at
     * @throws Exception
     */
    public function setUpdatedAt($updated_at)
    {
        if ($this->validateDate($updated_at)) {
            $this->updated_at = new DateTime($updated_at);
        } else {
            throw new Exception ('Date invalide !');
        }
    }
}