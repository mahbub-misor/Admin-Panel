<?php
include("php74.php");
session_start();
if(isset($_REQUEST['logout'])){
	session_destroy();
	header("location:index.php");	
}
if(!isset($_SESSION['name'])){
	//header("location:index.php");
	?>
     <a href="index.php">Back to Home</a>
    <?php
	die("Un Authorized access");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title> My Admin</title>
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/colour.css" type="text/css" media="screen" charset="utf-8" />
		<!--[if IE]><![if gte IE 6]><![endif]-->
		<script src="js/glow/1.7.0/core/core.js" type="text/javascript"></script>
		<script src="js/glow/1.7.0/widgets/widgets.js" type="text/javascript"></script>
		<link href="js/glow/1.7.0/widgets/widgets.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript">
			glow.ready(function(){
				new glow.widgets.Sortable(
					'#content .grid_5, #content .grid_6',
					{
						draggableOptions : {
							handle : 'h2'
						}
					}
				);
			});
		</script>
		<!--[if IE]><![endif]><![endif]-->
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	</head>
	<body>

	
		<h2 id="head">Welcome to <?php echo $_SESSION['name'];?><a style="font-size:16px; color:#fff; float:right" href="menu_manager.php?logout=yes">Logout</a></h2>

		<?php
			include("menus.php");
		?>

			
				<?php

$name=  null;
$title = null;
$content = null;				

		if(isset($_REQUEST['confirm'])){
			$id=$_REQUEST['confirm'];
			echo $obj->Delete("menus","menu_id=$id")?"Delete Success":"Delete Fail!";

		}

		if(isset($_REQUEST['del_id'])){
			$del_id=$_REQUEST['del_id'];
			?>
				Do you want to delete?<a href="menu_manager.php?confirm=<?=$del_id;?>">Yes</a>

				<a href="menu_manager.php">No</a>
			<?php

		}

		


	if(isset($_REQUEST['insert'])){
		/*echo "<pre>";
			print_r($_REQUEST);
		echo "</pre>";*/
		extract($_REQUEST);

	//echo $obj->Insert("students","name='$name',mobile='$mobile',address='$address'")?"Insert Success":"Insert Fail";
		if($obj->Insert("menus","name='$name',menu_title='$title',content='$content',status='$status'")){
			echo "<span class='text text-info'>Insert Success</span>";
		}
		else{

			echo "<span class='text text-danger'>Insert Fail</span>";
		}
}

if(isset($_REQUEST['edit'])){
		/*echo "<pre>";
			print_r($_REQUEST);
		echo "</pre>";*/
		extract($_REQUEST);

	if($obj->Update("menus","name='$name',menu_title='$title',content='$content',status='$status'","menu_id=$edit_id")){
			echo "<span class='text text-info'>Update Success</span>";
		}
		else{

			echo "Update Fail";
		}
}


			
				
				
	?>
	
	<table style="width:800px; margin:0 auto" cellpadding="5" cellspacing="0">
		<thead>
			<tr>
				<th colspan="5"> Show All Menus</th>
			</tr>
			<tr>
				
				<th> Name</th>
				<th> Title</th>
				<th> Status</th>
				<th> Action</th>
			</tr>
			</thead>
			<tbody>
			<?php
				$all_menus=$obj->getAll("menus","*");
				foreach($all_menus as $menu){
					extract($menu);
			?>
				<tr>
					<td><?=$name;?></td>
					<td><?=$menu_title;?></td>
					<td><?=$status==0?"Unpublish":"Publish";?></td>
					
					<td><a class="" href="menu_manager.php?action=edit&id=<?=$menu_id;?>">Edit</a> &nbsp;&nbsp; <a class="" href="menu_manager.php?del_id=<?=$menu_id;?>">Delete</a></td>
				</tr>
				<?php
			}
			?>
			<tr>
			<td colspan="5" style="text-align:right"><a href="menu_manager.php?action=insert">Add New Menu</a></td>
			</tr>
			</tbody>
	</table>
<br><br>
	<div>
		<?php
if(isset($_REQUEST['action'])){

		if($_REQUEST['action']=='edit'){

		$id=$_REQUEST['id'];
		extract($obj->getById("menus","*","menu_id=$id"));
	
					?>
	<form action="menu_manager.php" method="post">
	<table style="width:800px; margin:0 auto" class="table table-bordered table-stripped table-hover table-condensed"  width="500" cellpadding="5" cellspacing="0">
		<thead>
			<tr>
				<th colspan="2"> Edit Student</th>
			</tr>
			</thead>
			<tr>
				<th style="text-align:right">Name:</th>
				<td><input type="text" class="form-control" value="<?=$name;?>" name="name" size="30"></td>
			</tr>
			<tr>
				<th style="text-align:right">Title:</th>
				<td><input type="text" class="form-control" value="<?=$menu_title;?>"  name="title" size="30"></td>
			</tr>
			<tr>
				<th style="text-align:right">Content:</th>
				<td><textarea name="content" id="content"  rows="3" cols="20"><?=$content;?></textarea>
 			<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('content');
            </script>
				</td>
			</tr>
			<tr>
				<th style="text-align:right">Status:</th>
				<td>
					<select name="status">
					 <option value="0" <?php echo ($status==0)?'selected="selected"':''?>>Unpublish</option>
					 <option value="1" <?php echo ($status==1)?'selected="selected"':''?>>Publish</option>
					</select>

				</td>
			</tr>			
			<tr>
				
				<td colspan="2" style="text-align:center">
				<input type="hidden" name="edit_id" value="<?=$id;?>">
				<button type="submit"  class="btn btn-primary" name="edit" value="Update">Update</button></td>
			</tr>
		
	</table>

	</form>

					<?php
				}



				if($_REQUEST['action']=='insert'){

		?>
	<form action="menu_manager.php" method="post">
	<table style="width:800px; margin:0 auto" class=""  cellpadding="5" cellspacing="0">
		<thead>
			<tr>
				<th colspan="2"> Add New Menu</th>
			</tr>
			</thead>
			<tr>
				<th style="text-align:right">Name:</th>
				<td><input type="text" class="form-control" name="name" size="30"></td>
			</tr>
			<tr>
				<th style="text-align:right">Title:</th>
				<td><input type="text" class="form-control"  name="title" size="30"></td>
			</tr>
			<tr>
				<th style="text-align:right">Content:</th>
				<td><textarea name="content" id="content"  rows="3" cols="20"></textarea>
 			<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('content');
            </script>
				</td>
			</tr>
			
			<tr>
				<th style="text-align:right">Status:</th>
				<td>
					<select name="status">
					 <option value="0">Unpublish</option>
					 <option value="1">Publish</option>
					</select>

				</td>
			</tr>
			<tr>
				
				<td colspan="2" style="text-align:center"><button type="submit"  class="btn btn-primary" name="insert" value="Insert">Insert</button></td>
			</tr>
	</table>

	</form>
				<?php
				}
			}
		?>
	
			</div>
		<div id="foot">
			<div class="container_16 clearfix">
				<div class="grid_16">
					<a href="#">Contact Me</a>
				</div>
			</div>
		</div>
	</body>
</html>