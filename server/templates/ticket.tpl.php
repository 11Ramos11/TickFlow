<?php 
include_once(__DIR__.'/../classes/user.class.php');
include_once(__DIR__.'/../classes/ticket.class.php');
include_once(__DIR__.'/../classes/department.class.php');
include_once(__DIR__.'/../classes/chat.class.php');
?>

<?php function drawChat($ticket) { 
	
	$chat = $ticket->getChat();
	$author = User::getUserById($ticket->authorID);
	$assigned = User::getUserById($ticket->assignedID);
	$messages = $chat->getMessages();
	$messages = array_reverse($messages);
?>
	<main>
        <section id="chat">
            <div id="messages">
                <?php foreach($messages as $message) { ?>
				
				<?php if ($message->belongsToUser($author)) { ?>
                <article class="msg msg-right">
				<?php }  else { ?>
				<article class="msg msg-left">
				<?php } ?>
                    <figure class="avatar">
                        <img src="../images/profile.png" alt="Avatar">
                    </figure>
                    <div class="bubble">
                        <?=$message->content?>
                    </div>
                </article>
                <?php } ?>
            </div>
            <form action="/submit-message" method="post" class="reply">
                <input type="text">
                <button>Reply</button>
            </form>  
        </section>   
            
    </main>
<?php } ?>

<?php
function drawBriefTicket($ticket) { 
    $author =  User::getUserById($ticket->authorID);
	$assignedTo = User::getUserById($ticket->assignedID);
	$department = Department::getDepatmentByID($ticket->departmentID);
?>
	<aside class="right-sidebar">
		<article class="ticket-box brief">
			<h3><?=$ticket->subject?></h3>
			<section id="ticket-info">
				<p>Created: <span class="date"><?=$ticket->date?></span></p>
				<p>Status: <span class="status-tag"><?=$ticket->status?></span></p>
				<p>Priority: <span class="priority-tag"><?=$ticket->priority?></span></p>
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
			<?php if ($assignedTo != null) { ?>
				<p>Assigned to <a href="dashboard.php?id=<?=$assignedTo->id?>"><?=$assignedTo->name?></a> </p>
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