<?php
namespace App\Vk\HealthCareBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Vk\HealthCareBundle\Services\HealthCareService;
use App\Vk\HealthCareBundle\VkHealthCareBundle;
use Symfony\Component\HttpFoundation\JsonResponse;

class FormController extends AbstractController
{
   
   /** @var HealthCareService */
   private $healthCareServices;

    public  function __construct(HealthCareService $healthCareServices)
    {
       $this->healthCareServices=$healthCareServices;
    }
    public function index()
    {
       return $this->render('@VkHealthCare/enquerypage.php.twig');
    }
   public function postAction(Request $request)
   {
      $params=$request->request->all();
      
      try{
         //do stuff here
         // dd($params);
         // $form=$request->handleRequest();
         $postFile = $request->files->get('profile');
         $this->healthCareServices->saveUserInfo($params,$postFile);
         $this->addFlash(
            'success',
            'Data Save Successfully'
        );
          return $this->redirectToRoute('get_form_action');
     }
     catch(\Exception $e){
        
         return new JsonResponse($e->getMessage());
     }
     
   }

   public function  getFormData()
   {
   
      $formData=$this->healthCareServices->getFormData();
      
      return $this->render('@VkHealthCare/datagrid.php.twig',['formData'=>$formData]);
   }

   public function editFormData($id='',Request $request)
   {
      $formData=$this->healthCareServices->getFormData($id);
      
      return $this->render('@VkHealthCare/enqueryeditpage.php.twig',['formData'=>$formData]);
   }

   public function deleteForm($id,Request $request)
   {
       $this->healthCareServices->deleteForm($id);

       return $this->redirectToRoute('get_form_action');
   }

   public function createPostAction($id=null,Request $request)
   {
      if($request->isMethod('POST')){
         $params=$request->request->all();
         $postFile = $request->files->get('postfile');
         $formData=$this->healthCareServices->createPostAction($params,$postFile);
         return $this->redirectToRoute('get_form_action');
      }

      return $this->render('@VkHealthCare/postCreate.php.twig',['userId'=>$id]);
      
   }

   public function getMyPostAction(Request $request)
   {
      $userPost = $this->healthCareServices->getMyPost();
      
      return $this->render('@VkHealthCare/userPost.php.twig',['userPost'=>$userPost]);
   }

}