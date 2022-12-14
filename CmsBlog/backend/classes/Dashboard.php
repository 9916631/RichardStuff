<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 class Dashboard{
     protected $db;
     
     public function __construct(){
         $this->db = Database::instance();
         $this->user = new Users;;
     }
     
     public function blogAuth($blogID){
         //users class in user php
         $user_id = $this->user->ID();
         //selct from blog table making new table calling it B
         //join users from left table to right table to blogauth on A
         //where b exists on A and  the url is the same
         
         $stmt = $this->db->prepare("SELECT * FROM `blogs` `B`, `blogsAuth` `A`
                                              LEFT JOIN `users` `U` ON `A`.`userID` = `U`.`userID`
                                              WHERE `B`.`blogID` = `A`.`blogID` AND `B`.`blogID` = :blogID
                                              AND `U`.`userID` :userID");
        $stmt->bindParam(":blogID", $blogID, PDO::PARAM_INT);
        $stmt->bindParam(":userID", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
     }
     
     public function getAllPosts($type, $status = '', $blogID){
         //take all from posts table but join the users table id as the authorid in posts table
         $sql = "SELECT * FROM `posts`
                             LEFT JOIN `users` ON `userID` = `authorID` 
                             WHERE `postType` = :type AND `blogID` = :blogID
                             ORDER BY `postID` 
                             DESC LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":type", $type, PDO::PARAM_STR);
        $stmt->bindParam(":blogID", $blogID, PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        if($posts){
            foreach($posts as $post){
                //create object, date varible
                $date = new DateTime($post->createdDate);
                echo'
                <div class="m-r-c-inner">
                <div class="posts-wrap">
                <div class="posts-wrap-inner">
                <div class="post-link flex fl-row">
                	<div class="post-in-left fl-1 fl-row flex">
                		<div class="p-in-check">
                			<input type="checkbox" class="postCheckBox" value="'.$post->postID.'"/>
                		</div>
                		<div class="fl-1">
                			<div class="p-l-head flex fl-row">
                				<div class="pl-head-left fl-1">
                					<div class="pl-h-lr-link">
                						<a href="{POST-LINK}">'.$post->title.'</a>
                					</div>
                					<div class="pl-h-lf-link">
                						<ul>
                							'.$this->getPostLabels($post->postID, $post->blogID).'
                						</ul>
                					</div>
                				</div>
                				<div class="pl-head-right">
                					<span>'.(($post->postStatus === 'draft') ? 'Draft' : '').'</span>
                				</div>
                			</div>
                			<div class="p-l-footer">
                				<ul>
                					<li><a href="{EDIT-LINK}">Edit</a></li>|		
                					<li><a href="javascript:;" id="deletePost">Delete</a></li>
                				</ul>
                			</div>
                		</div>
                	</div>
                	<div class="post-in-right">
                	<div class="p-in-right flex fl-1">
                		<div class="pl-auth-name"><span>
                			<a href="javascript:;">'.$post->FullName.'</a></span>
                		</div>
                		<div class="pl-cm-count">
                			<span>0</span>
                			<span><i class="fas fa-comment"></i></span>
                		</div>
                		<div class="pl-views-count">
                			<span>0</span>
                			<span><i class="fas fa-eye"></i></span>
                		</div>
                		<div class="pl-post-date">
                			<span>'.$date->format('d/m/y').'</span>
                		</div> 
                	</div>
                	</div>
                </div>
                </div>
                </div>
                </div>
                ';
            }
        }else{
            echo'
           
            <div class="posts-wrap">
            <div class="posts-wrap-inner">
            	<div class="nopost flex">
            		<div>
            			<p>There are no '.$type.'s. </p><a href="{CREATE-POST-LINK}">Create a new '.$type.'</a>
            		</div>
            	</div>
            </div>
            </div>
            ';
        }
     }
     
     public function getPostLabels($postID, $blogID){
         $stmt = $this->db->prepare("SELECT * FROM `labels` WHERE `postID` = :postID AND `blogID` = :blogID");
         $stmt->bindParam(":postID", $postID, PDO::PARAM_INT);
         $stmt->bindParam(":blogID", $blogID, PDO::PARAM_INT);
         $stmt->execute();
         $labels = $stmt->fetchAll(PDO::FETCH_OBJ);
         $i = 1;
         $return = '';
         foreach($labels as $label){
             $return .='<li><a href="#">'.$label->labelName.'</a></li>'.(($i < count($labels)) ? ', ' : '');
             $i++;
         }
         return $return;
     }
     
     public function getLabelsMenu($blogID){
         $stmt = $this->db->prepare("SELECT * FROM `labels` WHERE `blogID` = :blogID");
         $stmt->bindParam("blogID", $blogID, PDO::PARAM_INT);
         $stmt->execute();
         $labels = $stmt->fetchAll(PDO::FETCH_OBJ);
         foreach($labels as $label){
             echo '<li><a href="javascript:;" data-id="'.$label->ID.'">'.$label->labelName.'</a></li>';
         }
     }
 }
?>