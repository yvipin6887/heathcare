<?php
namespace App\Vk\HealthCareBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Orm\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Vk\HealthCareBundle\Repository\UserInfoRepository")
 * @ORM\Table(name="user_info")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity
 */

class UserInfo{
   
    /** @var int */
     protected $id;

     /** @var string */
     protected $fullname;

     /**  @var int */
     protected $age;

     /** string */
     protected $bog;

     /** @var string */
     protected $phone;

     /** @var string */
     protected $address;

      /** @var string  */
      protected $userPost;

    /** @var blob  */
      protected $profile;

      public function __construct()
      {
          $this->userPost = new ArrayCollection();
      }


    
     public function getId():?int{
         return $this->id;
     }

     public function setId($id)
     {
        return $this->id=$id;
     }

     public function getFullName(): ?string
     {
         return $this->fullname;
     }

     public function setFullName(string $fullname){
         return $this->fullname=$fullname;
     }

     public function getAge():?int
     {
        return $this->age;
     }

     public function setAge($age)
     {
         return $this->age=$age;
     }

     public function getBog(): ?string
     {
        return $this->bog;
     }

     public function setBog($bog)
     {
         return $this->bog=$bog;
     }
     public function getPhone(): ?string
     {
        return $this->phone;
     }

     public function setPhone($phone)
     {
         return $this->phone=$phone;
     }

     public function getAddress(): ?string
     {
        return $this->address;
     }

     public function setAddress($address)
     {
         return $this->address=$address;
     }

     /**
      * @return Collection<int, UserPost>
      */
     public function getUserPost(): Collection
     {
         return $this->userPost;
     }

     public function addUserPost(UserPost $userPost): self
     {
         if (!$this->userPost->contains($userPost)) {
             $this->userPost[] = $userPost;
             $userPost->setUserInfo($this);
         }

         return $this;
     }

     public function removeUserPost(UserPost $userPost): self
     {
         if ($this->userPost->removeElement($userPost)) {
             // set the owning side to null (unless already changed)
             if ($userPost->getUserInfo() === $this) {
                 $userPost->setUserInfo(null);
             }
         }

         return $this;
     }

     public function getProfile()
     {
         return $this->profile;
     }

     public function setProfile($profile): self
     {
         $this->profile = $profile;

         return $this;
     }

   
     

    

}