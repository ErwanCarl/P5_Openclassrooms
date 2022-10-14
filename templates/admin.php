<?php ob_start();?>

<?php 
    if(isset($_SESSION['success'])) { 
?>
        <div class="alert alert-success" role="alert">
            <?php 
                $message = $_SESSION['success'];
                unset($_SESSION['success']);
                echo $message;
            ?>
        </div>
<?php 
    }elseif(isset($_SESSION['error'])){
?>
        <div class="alert alert-danger" role="alert">
            <?php
                $message = $_SESSION['error'];
                unset($_SESSION['error']);
                echo $message;
            ?>
        </div>
<?php
}
?>

<div class="adminNav">
    <div class="admin_title">
        <h1>Page d'administration</h1>
    </div>

    <hr class="passionBar">

    <div class="nav1">
        <nav>
            <ul>
                <li><a href="index.php?action=admin#commentValidation">Validation de commentaires</a></li>
                <li><a href="index.php?action=admin#gestionArticle">Gestion des articles</a></li>
                <li><a href="index.php?action=admin#permissions">Permissions utilisateurs</a></li>
            </ul>
        </nav>
    </div>
</div>

<hr class="adminBar">

<div class="section_title" id="commentValidation">
    <h2>Validation de commentaires</h2>
</div>

<?php if($pendingComments != null) { ?>

    <?php
        foreach($pendingComments as $pendingComment) {
    ?>

    <div class="comments_validation">
        <div class="validation_system">
            <div class ="comment_author">
                <?php echo htmlspecialchars('Auteur : '.$pendingComment['author'].' - Article : '.$pendingComment['title']); ?>
            </div>
            
            <div class ="comment_content">
                <?php echo htmlspecialchars($pendingComment['content']); ?>
            </div>
        </div>

        <div class="validation_button">
            <div class ="comment_button">
                <a href="index.php?action=validatecomment&id=<?= $pendingComment['id'] ?>" class="btn btn-success mb-2 active" role="button">Valider</a>
            </div>

            <div class ="comment_button">
                <a href="index.php?action=refusedcomment&id=<?= $pendingComment['id'] ?>" class="btn btn-danger mb-2 active" role="button">Refuser</a>
            </div>
        </div>
    </div>

    <?php
        }
    ?>

<?php }else{ ?>
	<div class="no_restauration_list">
		<p>Il n'y a pas de commentaires à modérer actuellement.</p>
	</div>
<?php } ?>

<div class="return_button" id="moderated_comment">
    <button type="button" onclick="window.location='index.php?action=moderatedcomment'" class="btn btn-info mb-2">Accéder à la liste des commentaires modérés</button>
</div>

<hr class="adminBar">

<div class="section_title" id="gestionArticle">
    <h2>Gestions des articles</h2>
</div>

<?php 
    if(isset($_SESSION['success2'])) { 
?>
        <div class="alert alert-success" role="alert">
            <?php 
                $message = $_SESSION['success2'];
                unset($_SESSION['success2']);
                echo $message;
            ?>
        </div>
<?php 
    }elseif(isset($_SESSION['error2'])){
?>
        <div class="alert alert-danger" role="alert">
            <?php
                $message = $_SESSION['error2'];
                unset($_SESSION['error2']);
                echo $message;
            ?>
        </div>
<?php
}
?>

<div class="return_button">
    <button type="button" onclick="window.location='index.php?action=postcreation'" class="btn btn-success mb-2">Créer un article</button>
</div>

<div class="post_administration">
    <?php 
        foreach ($posts as $post) {
    ?>

    <div class="work_creation" id="admin_creation">
        <div class="title_bloc">
            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        </div>
        <div class="post_bloc">
            <div class="pic_bloc">
                <a href="index.php?action=post&id=<?= urlencode($post['id']) ?>">
                    <div class="posts_picture">
                        <img id="pic_base" src="<?php echo htmlspecialchars($post['picture']); ?>">
                        <img id="pic_hover" src="images/loupe_post_hover.png">
                    </div>
                </a>
            </div>
            <div class="info_bloc">
                <div class="author_bloc">
                    <h4><?php 
                    if($post['modificationDate'] === null) {
                        echo htmlspecialchars($post['author'].' - Date de création : '.$post['creationDate']);
                    }else{
                        echo htmlspecialchars($post['author'].' - Dernière modification : '.$post['modificationDate']);
                    }?>
                    </h4>
                </div>

                <hr>

                <div class="chapo_bloc">
                    <h4><?php echo htmlspecialchars($post['chapo']); ?></h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="post_admin_page">
        <div class="return_button">
            <button type="button" onclick="window.location='index.php?action=postmodify&id=<?= urlencode($post['id']) ?>'" class="btn btn-warning mb-2">Modifier</button>
        </div>

        <div class="return_button">
            <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#exampleModal">Supprimer</button>
        </div>
        
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Suppression d'article</h5>
                    </div>
                    <div class="modal-body">
                        <p>Voulez vous vraiment supprimer cet article ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger" onclick="window.location='index.php?action=postdelete&id=<?= urlencode($post['id']) ?>'">Confirmer</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php
    }
    ?>		

</div>
		
<hr class="adminBar">

<div class="section_title" id="permissions">
    <h2>Permissions utilisateurs</h2>
</div>

<?php 
	if(isset($_SESSION['success3'])) { 
?>
		<div class="alert alert-success" role="alert">
			<?php 
				$message = $_SESSION['success3'];
				unset($_SESSION['success3']);
				echo $message;
			?>
		</div>
<?php 
	}elseif(isset($_SESSION['error3'])){
?>
		<div class="alert alert-danger" role="alert">
			<?php
				$message = $_SESSION['error3'];
				unset($_SESSION['error3']);
				echo $message;
			?>
		</div>
<?php
}
?>


<div class="user_administration">
    <form class="user_search_form" action="index.php?action=usersearch" method="post">
        <div class="form_case">
            <label for="pseudo">Rechercher un utilisateur</label>
        </div>
        <div class= "search_bloc">
            <input required type="text" name="pseudo" id="pseudo" placeholder="Rentrez le pseudo d'un utilisateur">
			<button type="submit" class="btn btn-primary" id="search_button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg> 
            </button>
		</div>
    </form>
</div>

<?php if(isset($_SESSION['userChange'])) { ?>
    <div class="role_change_bloc">
        <form class="form_role_change" action="index.php?action=changerole" method="post">
            <div class="usernamefound_bloc">
                <p>Utilisateur : <span><?php echo htmlspecialchars($_SESSION['userChange']['username']); ?></span></p>
                <p>Rôle actuel : <span><?php echo htmlspecialchars($_SESSION['userChange']['role']); ?></span></p>
            </div>
            <div class="set_user_role">
                <label for="role">Changer le rôle de l'utilisateur : </label>
                <select name="role" id="role">
                    <option value="admin">Administrateur</option>
                    <option value="user">Utilisateur</option>
                </select>
            </div>
            <div class="form_button">
                <button type="submit">Valider</button>
            </div>
        </form>
    </div>

<?php } ?>

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>