<?php

    //include api processors
    require "processor.php";

    //instantiate apiProcessor
    $processor = new apiProcessor();
    $uname = $_POST['uname'];

   $data = $processor->fetchMyrec($uname);
   //count array elements
   $elements = count($data);
   if ($elements > 0) {
       //interate over the head array
       foreach ($data as $detail):
       //make an object or the details
       ?>

                <div class='list-cont' data-id="<?php echo $detail['id'] ?>">
                    <div class='list-cont-sub'>
                        <?php echo $detail['item_name'] ?>
                    </div>
                    <div class='list-cont-sub'>
                    <?php echo $detail['item_id'] ?>
                    </div>
                    <div class='list-cont-sub' >
                        <div class='list-but edit-but' data-edit="<?php echo $detail['id'] ?>" onclick="editList(event)" >
                            <i class='fas fa-edit rec-edit edit-but' data-edit="<?php echo $detail['id'] ?>" title="Edit"></i>
                        </div>

                        <div class='list-but' data-delete="<?php echo $detail['id'] ?>"  >
                            <i class='fas fa-window-close rec-cancel' title="Delete" data-delete="<?php echo $detail['id'] ?>" onclick="deleteList(event)"></i>
                        </div>
                    </div>
                    <div style='clear:both'></div>
                </div>

       <?php

         endforeach;
         ?>
            <div class="complete-box">
            <div class="complete-done" data-done="<?php echo $detail['reg_uname'] ?>" onclick="listDone(event)">Done</div>
            <div class="complete-delete" data-delete="<?php echo $detail['reg_uname'] ?>" onclick="listDelete(event)">Delete List</div>
                <div style="clear:both"></div>
            </div>
         <?php
   }else{
       echo "No records yet ";
   }

   ?>
  
