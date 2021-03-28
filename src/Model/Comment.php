<?php

namespace Blog\Model;

use DateTime;
use Exception;

/**
 * Class Comment
 */

class Comment extends Model
{
    private $id;
    private $post_id;
    private $content;
    private $author;
    private $status;
    private $created_at;
    private $updated_at;

    /**
     * @return mixed
     */
    public function getId()
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
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @param $post_id
     */
    public function setPostId($post_id)
    {
        $this->post_id = (int) $post_id;
    }

    /**
     * @return mixed
     */
    public function getContent()
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
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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