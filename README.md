# Breadcrumb for Symfony 4 and Symfony 5
1. instalation
   ```
   composer require kematjaya/breadcrumb-bundle
   ```
2. update config/bundles.php
   ```
   Kematjaya\Breadcrumb\KmjBreadcrumbBundle::class => ['all' => true]
   ```
3. usage in controller
   ```
   namespace App\Controller;
   
   use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
   use Kematjaya\Breadcrumb\Lib\Builder as BreacrumbBuilder;
   use Symfony\Component\Routing\Annotation\Route;
   
   /**
   * @Route("/item")
   */
   class MyController extends AbstractController
   {
       /**
       * @Route("/", name="item_index")
       */
       public function index(BreacrumbBuilder $builder)
       {
           $builder->add('item');
           
           ....
       }
       
       /**
       * @Route("/create", name="item_create")
       */
       public function create(BreacrumbBuilder $builder)
       {
           $builder->add('item', 'item_index');
           $builder->add('create');
           
           ...
       }
   }
   ```
4. use in twig
   ```
   <div class="pull-right">
      {{ kmj_breadcrumb() }}
   </div>
   ```
