<?php
    //include staff handle
    require "inc/handles/staff_handler.php";

    $token = $_SESSION['token'];

    //instantiate staffhander

    $staffHandler = new Staffhandler();
    $my_details = $staffHandler->getMyDetail($token);
    

?>
<main class="display-main">

        <?php
            $id = $my_details['id'];
            $name = $my_details['lname'].$my_details['fname'];
            $uname = $my_details['uname'];
            $position = $my_details['position'];
            $addr = $my_details['home_address'];
            $email = $my_details['email'];
            $phone_number = $my_details['phone_number'];
            $permission = $my_details['permission'];
            $gender = $my_details['gender'];
            $created_at = $my_details['created_at'];
            $img = $my_details['image'];
            $status = $my_details['status'];
            $activity = $my_details['activity'];
            if($img == ''){
                $img = "src/images/avartar.jpg";
            }

            if($activity == 0 ){
                $activity_rep = "act-online"; 
                $act = "Online";
            }else{
                $activity_rep = "act-offline";
                $act = "Offline";
            }


            if($status == 0){
                $status_rep = "status-active";
                $stat = "Account active";
            }else{
                $status_rep = "status-blocked";
                $stat = "Account blocked";
            }

            
           

        ?>

<section class="staff-box">
        <div class="staff-img">
            <img src="<?php echo $img; ?>" alt="Profile image" />
        </div>

        <div class="profile-name"> 
            <?php echo $name; ?>
         </div>

         <div class="profile-position"> 
            <?php echo $position ?>
         </div>

         <div class="profile-list">
            <span>Email:</span>
            <span><?php echo $email ?></span>
            <div style="clear:both"></div>
         </div>

         <div class="profile-list">
            <span>Phone:</span>
            <span><?php echo $phone_number ?></span>
            <div style="clear:both"></div>
         </div>

         <div class="profile-list">
            <span>Username:</span>
            <span><?php echo $uname ?></span>
            <div style="clear:both"></div>
         </div>

         <div class="profile-list">
            <span>Address:</span>
            <span><?php echo $addr ?></span>
            <div style="clear:both"></div>
         </div>

         <div class="profile-list">
            <span>Gender:</span>
            <span><?php echo $gender ?></span>
            <div style="clear:both"></div>
         </div>

         <div class="profile-list">
            <span>Date registered:</span>
            <span><?php echo $created_at ?></span>
            <div style="clear:both"></div>
         </div>

         <div class="monitor-div">
            <div class="monitor-child  <?php echo $activity_rep ?> stretch">
            <?php echo $act ?>
            </div>
         <div style="clear:both"></div>
         </div >
        
    </section>


    <?php 
    
        $users_array = $staffHandler->getUsers();
        //loop staff box
        foreach($users_array as $user):
            $id = $user['id'];
            $name = $user['lname'].$user['fname'];
            $uname = $user['uname'];
            $position = $user['position'];
            $addr = $user['home_address'];
            $email = $user['email'];
            $phone_number = $user['phone_number'];
            $permission = $user['permission'];
            $gender = $user['gender'];
            $created_at = $user['created_at'];
            $img = $user['image'];
            $status = $user['status'];
            $activity = $user['activity'];
            if($img == ''){
                $img = "src/images/avartar.jpg";
            }

            if($activity == 0 ){
                $activity_rep = "act-online"; 
                $act = "Online";
            }else{
                $activity_rep = "act-offline";
                $act = "Offline";
            }


            if($status == 0){
                $status_rep = "status-active";
                $stat = "Account active";
            }else{
                $status_rep = "status-blocked";
                $stat = "Account blocked";
            }

            if($_SESSION['token'] == $uname){
                continue;
            }
           
    ?>
    <section class="staff-box">
        <div class="staff-img">
            <img src="<?php echo $img; ?>" alt="Profile image" />
        </div>

        <div class="profile-name"> 
            <?php echo $user['lname'].' '.$user['fname']; ?>
         </div>

         <div class="profile-position"> 
            <?php echo $position ?>
         </div>

         <div class="profile-list">
            <span>Email:</span>
            <span><?php echo $email ?></span>
            <div style="clear:both"></div>
         </div>

         <div class="profile-list">
            <span>Phone:</span>
            <span><?php echo $phone_number ?></span>
            <div style="clear:both"></div>
         </div>

         <div class="profile-list">
            <span>Username:</span>
            <span><?php echo $uname ?></span>
            <div style="clear:both"></div>
         </div>

         <div class="profile-list">
            <span>Address:</span>
            <span title="<?php echo $addr; ?>"><?php echo substr($addr,0, 100) ?> </span>
            <div style="clear:both"></div>
         </div>

         <div class="profile-list">
            <span>Gender:</span>
            <span><?php echo $gender ?></span>
            <div style="clear:both"></div>
         </div>

         <div class="profile-list">
            <span>Date registered:</span>
            <span><?php echo $created_at ?></span>
            <div style="clear:both"></div>
         </div>

         <div class="monitor-div">
            <div class="monitor-child <?php echo $activity_rep ?>">
            <?php echo $act ?>
            </div>
            <div data-id = "<?php echo $id; ?>" class="monitor-child  stat-changer  <?php echo $status_rep; ?>">
            <?php echo $stat; ?>
            </div>
         <div style="clear:both"></div>
         </div >
        
    </section>
    
    <script>
        window.onload = () =>{
            but = document.querySelectorAll(".stat-changer");
            let forEach = Array.prototype.forEach;
            forEach.call((but), (item)=>{
                item.addEventListener('click',(event) => {
                    event.target.textContent = 'Loading';
                    let id = event.target.dataset.id;
                    let formData = new FormData();
                    formData.append("data", id);
                    
                    let api = "apiControllers/statusProcessor.php";
                    let fetchData = {
                        method: "POST",
                        body: formData,
                        headers: new Headers()
                    }
                    fetch(api, fetchData)
                    .then((response) => response.text())
                    .then((data) => {
                        //update data
                        event.target.textContent = data;
                        if(event.target.classList.contains('status-active')){
                            event.target.classList.remove('status-active');
                            event.target.classList.add('status-blocked');
                        }else{
                            event.target.classList.remove('status-blocked');
                            event.target.classList.add('status-active');
                        }
                    })
                    .catch((error) => console.log(error)) 

                });
            });
        }
    </script>
    
    

    <?php
        //end staff box loop
        endforeach;
     ?>

<div style="clear:left"></div>

</main>
