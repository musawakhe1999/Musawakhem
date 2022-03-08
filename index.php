<html>
   <head>
</head>
<body>

   <?php
use Goutte\Client;

class webscrapping{



function selectData(){

   include "vendor/autoload.php";
   
   

   if(isset($_POST['submit'])){

      //validation
      if (empty($_POST["name"])) {
         echo '<script type="text/javascript">';
         echo ' alert("Put a link on textfield")';  
         echo '</script>';
         
       } else{

             $cr=new Client();
           $cr_=$cr->request("GET",$_POST['name']);



      
//taking data from website
$cr_->filter("div.page-content")->each(function($node){
   $title=$node->filter("div.page-title")->text();
   $lyrics=$node->filter("div.col-xs-12.text-md-center")->text();
   $singers=$node->filter("div.item-author.text-md.flex.items-center")->text();

   echo $title."<br>".$lyrics.",<br>".$singers."<br>";
   
   //writting csv file
  $file_open=fopen("contact_data.csv","a");
  $no_rows=count(file("contact_data.csv"));
  if($no_rows>1)
      {
         $no_rows=($no_rows-1)+1;
      }
      $form_data=array(
         'Tittle'=>$title,
         'Lyrics'=>$lyrics,
         'Singers'=>$singers 
      );
      fputcsv($file_open,$form_data);
   

        }
);}
   }
}




  

}

//creating object and call method
$link1=new webscrapping();
 $link1->selectData();





   ?>
   <form name="myForm"action="" method="POST">
      <h1>Insert link of a song from africa lyrics AND press submit</h1>
      <input type="text" name="name" >
      <script Type="javascript">alert("JavaScript Alert Box by PHP")</script>
      <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>


