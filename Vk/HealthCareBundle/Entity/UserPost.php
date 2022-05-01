<?php

namespace App\Vk\HealthCareBundle\Entity;

use Doctrine\Orm\Mapping as ORM;

class UserPost{

    /** @var int */
    protected $id;

     /** @var string */
     protected $title;

      /** @var string */
      protected $description;

       /** @var blob */
     protected $image;

     /** @var string  */
     protected $userInfo;

     /** @var datetime */
     protected $datetime;

     public function getId(): ?int
     {
         return $this->id;
     }

     public function getTitle(): ?string
     {
         return $this->title;
     }

     public function setTitle(?string $title): self
     {
         $this->title = $title;

         return $this;
     }

     public function getDescription(): ?string
     {
         return $this->description;
     }

     public function setDescription(?string $description): self
     {
         $this->description = $description;

         return $this;
     }

     public function getImage()
     {
         return $this->image;
     }

     public function setImage($image): self
     {
         $this->image = $image;

         return $this;
     }

     public function getUserInfo(): ?UserInfo
     {
         return $this->userInfo;
     }

     public function setUserInfo(?UserInfo $userInfo): self
     {
         $this->userInfo = $userInfo;

         return $this;
     }

     public function getDatetime(): ?\DateTimeInterface
     {
         return $this->datetime;
     }

     public function setDatetime(?\DateTimeInterface $datetime): self
     {
         $this->datetime = $datetime;

         return $this;
     }

}