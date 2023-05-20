<?php 
include_once(__DIR__.'/../classes/user.class.php');
include_once(__DIR__.'/../classes/ticket.class.php');
include_once(__DIR__.'/../classes/department.class.php');
include_once(__DIR__.'/../classes/chat.class.php');
include_once(__DIR__.'/../classes/priority.class.php');
include_once(__DIR__.'/../classes/status.class.php');

?>

<?php function getArticleTag($message, $sessionUser, $author) {
	if ($sessionUser->id == $author->id) { ?>
		<?php if ($message->belongsToUser($author)) { ?>
			<article class="msg msg-right author">	
		<?php }  else { ?>
			<article class="msg msg-left">
		<?php }  ?>
	<?php } else { ?>
		<?php if ($message->belongsToUser($author)) { ?>
			<article class="msg msg-left">
		<?php } else { if ($message->author == $sessionUser->id) {?>
			<article class="msg msg-right author">
		<?php } else { ?>
			<article class="msg msg-right">
		<?php }
		}
	} 
}?>
<?php function drawChat($ticket) { 
	
	$chat = $ticket->getChat();
	$author = User::getUserById($ticket->authorID);
	$messages = $chat->getMessages();
	$messages = array_reverse($messages);
	$session = new Session();
	$sessionUser = $session->getUser();
?>
	<main class="middle-column"> 
        <section id="chat">
            <div id="messages">
                <?php foreach($messages as $message) { ?>
					<?php getArticleTag($message, $sessionUser, $author) ?>
						<figure class="avatar">
							<img src="../images/profile.png" alt="Avatar">
						</figure>
						<section class="bubble">
							<p class="name"><?=$message->authorName?></p>
							<p class="message"><?=$message->content?></p>
						</section>
					</article>
                <?php } ?>
            </div>
            <section class="reply">
                <input id="message-input" type="text">
                <button type="button" id="send-message-button" >Reply</button>
            </section>  
			<p hidden id="ticket-id"><?=$ticket->id?></p>
			<p hidden id="user-id"><?=$sessionUser->id?></p>
			<p hidden id="ticket-author-id"><?=$author->id?></p>
        </section>   
            
    </main>
<?php } ?>

<?php
function drawBriefTicket($ticket) { 
    $author =  User::getUserById($ticket->authorID);
	if ($ticket->assigneeID != null)
		$assignee = User::getUserById($ticket->assigneeID);
	else
		$assignee = null;
	$department = Department::getDepatmentByID($ticket->departmentID);
	$status = Status::getStatusById($ticket->status);
	$priority = Priority::getPriorityById($ticket->priority);
?>
	<aside class="right-sidebar">
		<article class="ticket-box brief">
			<h3><?=$ticket->subject?></h3>
			<section id="ticket-info">
				<p>Created: <span class="date"><?=$ticket->date?></span></p>
				<p>Status: <span class="status-tag"><?=$status->name?></span></p>
				<p>Priority: <span class="priority-tag"><?=$priority->name?></span></p>
				<ul class="tags">
					<?php foreach ($ticket->tags as $tag) { ?>
					<li class="tag"> <?= $tag ?> </li>
					<?php } ?>
				</ul>
				<p><?=$ticket->description?></p>
				<p>Department: <a><?=$department == null ? "None" : $department->name?></a> </p>
			</section>
		</article>
		<article class ="assigned-to">
			<?php if ($assignee != null) { ?>
				<p>Assigned to <a href="dashboard.php?id=<?=$assignee->id?>"><?=$assignee->name?></a> </p>
			<?php } else { ?>
				<p>Not Assigned </p>
			<?php } ?>
			<div class = "person-card">
				<img src="../images/profile.png" alt="Profile" class="profile-img"></img>
				<p>Written by <a href="dashboard.php?id=<?=$author->id?>"><?=$author->name?></a> </p>
			</div>	
		</article>
	</aside>
<?php } ?>