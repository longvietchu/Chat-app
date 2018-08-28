<?php
$username = $this->Session->read('user.name');
$message_value = "";
$edit_status = "";
if(!empty($edit_data)){
	$message_value = $edit_data['tFeed']['message'];
	$edit_status = $edit_data['tFeed']['id'];
}
?>
<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="/chat/feed"><strong>Simple Chat System</strong></a>
	<form class="form-inline" action="/user/logout">
		<button type="submit" class="btn btn-outline-danger">Logout</button>
	</form>
</nav>

<input id="edit-status" type="hidden" value="<?php echo $edit_status ?>">
<!-- Send Message -->
<div class="row">
	<div class="col-12">
		<div class="col-sm-11 align-items-end" style="margin: 0 auto">
			<form action="/chat/feed" method="post">
				<div class="form-group">
					<label><strong>Name</strong></label>
					<div class="input-group mb-3">
						<?php echo '<div class="form-control" aria-describedby="button-addon2">'.$username.'</div>'?>
						<input type="hidden" name="name" value="<?php echo $username ?>">
						<div class="input-group-append">
							<button class="btn btn-outline-primary" type="submit" id="btn-send" name="send">Send</button>
							<button class="btn btn-outline-success" type="submit" id="btn-save" name="edit">Save</button>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label><strong>Message</strong></label>
					<textarea class="form-control" rows="3" name="message"><?php echo $message_value ?></textarea>
				</div>
			</form>
		</div>

		<!-- Display Errors -->
		<?php
		if(!empty($errors)){
			echo '<div class="alert alert-danger">';
			echo($errors['message'][0]);
			echo '</div>';
		}
		?>

		<!-- Display Message -->
		<?php foreach($message_views as $message): ?>
			<?php $message_id = $message['tFeed']['id'] ?>
			<div class="display-msg">
				<p class="msg">
					<?php 
					echo "<strong>".$message['tFeed']['name']."> "."</strong>";
					echo $message['tFeed']['message']." ";
					echo $message['tFeed']['update_at']; 
					?>
				</p>
				<div class="msg-option">
					<?php
					if($message['tFeed']['name'] == $username){
						echo $this->Html->link('Edit',
							array(
								'action' => 'feed',
								$message_id
							),
							array(
								'id' => 'btn-edit',
								'class' => 'btn btn-outline-dark'
							)
						);

						echo $this->Form->postLink('Delete',
							array(
								'action' => 'delete',
								$message_id
							),
							array(
								'id' => 'btn-del',
								'class' => 'btn btn-outline-danger',
								'confirm' => 'Are you sure?'
							)
						);
					}
					?>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>