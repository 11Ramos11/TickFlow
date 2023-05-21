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
<?php function drawChat($ticket, $departments) { 
	
	$chat = $ticket->getChat();
	$author = User::getUserById($ticket->authorID);
	$messages = $chat->getMessages();
	$messages = array_reverse($messages);
	$session = new Session();
	$sessionUser = $session->getUser();
?>
	<main class="middle-column"> 
		<a href="../pages/ticket.php?ticket=<?=$ticket->id?>">
		<i id="refresh-button" class="fa-solid fa-arrows-rotate"></i>
		</a>
        <section id="chat">
            <div id="messages">
                <?php foreach($messages as $message) { ?>
					<?php getArticleTag($message, $sessionUser, $author) ?>
						<figure class="avatar">
							<img src=<?=$message->authorPhoto?> alt="Avatar">
						</figure>
						<section class="bubble">
							<p class="name"><?=$message->authorName?></p>
							<p class="message"><?=$message->content?></p>
						</section>
					</article>
                <?php } ?>
            </div>
            <section class="reply">
				<?php if ($sessionUser->isAgent()) { ?>
				<button type="button" id="faq-button">FAQ's</button>
				<?php } ?>
                <input id="message-input" type="text">
                <button type="button" id="send-message-button" >Reply</button>
            </section>  
			<p hidden id="ticket-id"><?=$ticket->id?></p>
			<p hidden id="user-id"><?=$sessionUser->id?></p>
			<p hidden id="ticket-author-id"><?=$author->id?></p>
        </section>   
		<dialog id="faq-dialog">
		<?php foreach($departments as $department) {
            $faqs = $department->getFAQs(); ?>
            <?php if (count($faqs) == 0) continue; ?>
            <section class="department-faqs">
                <h2> <?=$department->name ?> </h2>
                <?php foreach($faqs as $faq) { ?>
                <div class="edit-container faq-container container">
					<button class="use-faq" type="button" data-question="<?=$faq->question?>" data-answer="<?=$faq->answer?>">
					<i class="fa-solid fa-paste"></i>
					</button>
                    <article class="edit-card FAQ-card card">
                        <h3 class="question"> <?=$faq->question?> </h2>
                        <p class="answer"> <?=$faq->answer?> </p>
                    </article>
                </div>
                <?php } ?>
            </section>
        <?php } ?>
		</dialog> 
		<style>
			#faq-dialog {
				width: 60%;
				height: 80%;
				background-color: white;
				border-radius: 10px;
				padding: 20px;
				overflow-y: scroll;
			}

			#faq-button {
				margin-right: 0.5rem;
			}
			.use-faq {
				position: absolute;
				right: 0;
				top: 0;
				border: none;
				background-color: transparent;
				padding: 0.5rem;
				border-radius: 5rem	;
				cursor: pointer;
				z-index: 4;
			}
			.use-faq i {
				color: blue;
			}
			#refresh-button {
				font-size: 1.5rem;
				padding: 0.8rem;
				background-color: blue;
				color: white;
				border-radius: 100%;
			}
		</style>
    </main>
<?php } ?>

<?php
function drawBriefTicket($ticket, $author, $assignee, $department, $status, $priority, $sessionUser, $page) { ?>
	<aside class="right-sidebar">
		<section class="manage-ticket"> 
			<?php if ($page != "ticket") { ?>
			<a href="../pages/ticket.php?ticket=<?=$ticket->id?>" id="ticket-button" class="button">Ticket</button></a>
			<?php } ?>
			<?php if ($page != "edit") { ?>
			<a href="../pages/editTicket.php?ticket=<?=$ticket->id?>" id="edit-button" class="button">Edit</button></a>
			<?php } ?>
			<?php if ($page != "history") { ?>
				<?php if ($sessionUser->isAgent()) { ?>
				<a href="../pages/history.php?ticket=<?=$ticket->id?>"><button id="changes-button" class="button">History</button></a>
				<?php } ?>
			<?php } ?>
		</section>
		<article class="ticket-card brief">
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
			<div class = "person-card">
				<img src=<?=$assignee->getPhoto()?> alt="Profile" class="profile-img"></img>
				<p>Assigned to <a href="dashboard.php?id=<?=$assignee->id?>"><?=$assignee->name?></a> </p>
			</div>
			<?php } else { ?>
				<p>Not Assigned </p>
			<?php } ?>
			<div class = "person-card">
				<img src=<?=$author->getPhoto()?> alt="Profile" class="profile-img"></img>
				<p>Written by <a href="dashboard.php?id=<?=$author->id?>"><?=$author->name?></a> </p>
			</div>	
		</article>
	</aside>
<?php } ?>