<?php

    /**
     * Data Create
     */

     function create($path, array $newData){
          //sent devs dat to json db
          $data = json_decode(file_get_contents($path), true);

          array_push($data , $newData);
          
          file_put_contents($path, json_encode($data));
     }
/*
     function create($path, $newdata){
     $olddata = json_decode(file_get_contents($path), true);
      array_push($olddata, $newdata);
      json_encode(file_put_contents($path), $olddata);
     }
*/
     /**
      * DAta 
      */
      function all($path){
        return json_decode(file_get_contents($path), false);
      }

/**
 * find id single 
 */
      function find($path , $id) {
         $data = json_decode(file_get_contents($path), false);

          foreach($data as $item){

               if($item->id == $id){
                    return $item;
               }
          }
      }

?>