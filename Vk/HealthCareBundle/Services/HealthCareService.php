<?php
namespace App\Vk\HealthCareBundle\Services;

use App\Vk\HealthCareBundle\Entity\UserInfo;
use App\Vk\HealthCareBundle\Entity\UserPost;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\Slugger\SluggerInterface;

class HealthCareService{

    protected $doctrine;

    protected $slugger;

    public function __construct(ManagerRegistry $doctrine, SluggerInterface $slugger)
    {
        $this->doctrine = $doctrine;
        $this->slugger = $slugger;
    }

    public function saveUserInfo($params=null,$postFile){
       $entityManager=$this->doctrine->getManager();
       if(isset($params['updateId'])){
           $userInfo=$entityManager->getRepository(UserInfo::class)->find($params['updateId']);
       }else{
        $userInfo=new UserInfo(); 
       }
       if($postFile){
        $originalFilename = pathinfo($postFile->getClientOriginalName(), PATHINFO_FILENAME);
        
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$postFile->guessExtension();
        // Move the file to the directory where brochures are stored
        try {
            $postFile->move(
                'uploads/posts',
                $newFilename
            );
            $userInfo->setProfile($newFilename);;
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }
    }
       $userInfo->setFullName($params['fullname']);
       $userInfo->setAge($params['age']);
       $userInfo->setBog($params['bloodgroup']);
       $userInfo->setBog($params['bloodgroup']);
       $userInfo->setPhone($params['phone_no']);
       $userInfo->setAddress($params['address']);
       $entityManager->persist($userInfo);
       $entityManager->flush();

       return true;
    }

    public function getFormData($id=null){
        if(!is_null($id)){

            return $this->doctrine->getRepository(UserInfo::class)->find($id);
        }else{

            return $this->doctrine->getRepository(UserInfo::class)->findAll();
        }
        
    }

    public function deleteForm($id){
        $entityManager=$this->doctrine->getManager();
        $userInfo=$entityManager->getRepository(UserInfo::class)->find($id);
        $entityManager->remove($userInfo);
        $entityManager->flush();
        
        return true;
    }

    public function createPostAction($data,$postFile){
        $entityManager=$this->doctrine->getManager();

        $userInfo=$entityManager->getRepository(UserInfo::class)->find($data['updateId']);
        $userPost = new UserPost();
        if($postFile){
            $originalFilename = pathinfo($postFile->getClientOriginalName(), PATHINFO_FILENAME);
            
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$postFile->guessExtension();
            // Move the file to the directory where brochures are stored
            try {
                $postFile->move(
                    'uploads/posts',
                    $newFilename
                );
                $userPost->setImage($newFilename);;
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
        }
        $date = new DateTime();
        $userPost->setUserInfo($userInfo);
        $userPost->setTitle($data['title']);
        $userPost->setDescription($data['description']);
        $userPost->setDatetime($date);
        $entityManager->persist($userPost);
        $entityManager->flush();

        return true;
    }

    public function getMyPost()
    {
        $entityManager=$this->doctrine->getManager();
        $userPost = $entityManager->getRepository(UserInfo::class)->getUserByAllPost();
        // $postData=[];
        // if($userPost)
        // {
        //     foreach($userPost as $postKey=>$postValue)
        //     {
        //     }
        // }
        // dd($userPost);
        return $userPost;
    }


}