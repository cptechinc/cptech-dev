<?php 
    $user = $session->forceLogin('rcapsys');
    $dplusdatabase = $modules->get('DplusDatabase');
?>
<?php include('./_head.php'); ?>
	<main role="main">
		<div class="jumbotron bg-dark text-light">
			<div class="container">
				<h1 class="display-3"><?= $page->get('pagetitle|headline|title') ; ?></h1>
			</div>
		</div>
		<div class="container page">
            <?= $page->body; ?>
            <h2>Database Table SQL</h2>
            
			<div class="pl-5 pr-5 code-div">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-sm pull-right" onclick="selectText('db-tables')">Copy</button>
                        </div>
                    </div>
                </div>
                
                
                <code id="db-tables">
                    <?= $dplusdatabase->get_dbtablestructure() ?>
                </code>
            </div>
		</div>
	</main>
<?php include('./_foot.php'); // include footer markup ?>
