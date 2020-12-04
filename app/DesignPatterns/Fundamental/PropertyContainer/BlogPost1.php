<?php


namespace App\DesignPatterns\Fundamental\PropertyContainer;


class BlogPost1 extends PropertyContainer
{
    private $title;
    private $category_id;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategory($category_id)
    {
        $this->category_id = $category_id;
    }
}
