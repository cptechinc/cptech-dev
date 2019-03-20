<?php
	use Dplus\ProcessWire\DplusWire;

	/**
	 * Creates a hash for a template file
	 * @param  string $pathtofile Path to file from templates/
	 * @return string             Hash for file
	 */
	function hash_templatefile($pathtofile) {
		return hash_file(DplusWire::wire('config')->userAuthHashType, DplusWire::wire('config')->paths->templates.$pathtofile);
	}

	/**
	 * Gets a URL for a template file with its hash
	 * @param  string $pathtofile Path to file from templates/
	 * @return string             URL for templatefile with hash
	 */
	function get_hashedtemplatefileurl($pathtofile) {
		$hash = hash_templatefile($pathtofile);
		return DplusWire::wire('config')->urls->templates."$pathtofile?v=$hash";
	}

	function throw_error($error, $level = E_USER_ERROR) {
		trigger_error($error, $level);
		return;
	}

	/**
	 * Imports and Saves the commits as ProcessWire\Pages
	 * @param  ProcessWire\Page $commitspage template = 'repository-commits'
	 * @param  array            $commits     array <GitHubCommit>
	 * @return void
	 */
	function import_commits(ProcessWire\Page $commitspage, array $commits) {
		$mergematch = '/(merge)/i';
		$github_dateformat = DplusWire::wire('config')->github_dateformat;

		if ($commitspage->template == 'repository-commits') {
			// Foreach loop will go here :
			$array = array();
			foreach ($commits as $commit) {
				$sha = $commit->getSha();
				// Use $commitpage->numChildren("name=$sha") because now the $commit page will be
				// a Page with a template of repository-commits
				if (!$commitspage->numChildren("name=$sha")) {
					$p = new Page();
					$p->of(false);
					$p->template = 'repository-commit';
					$p->parent = $commitspage;
					$p->name = $commit->getSha();
					$p->title = $commit->getSha();
					$p->body = $commit->getCommit()->getMessage();
					$p->is_merge = boolval(preg_match($mergematch, $commit->getCommit()->getMessage()));
					$p->date = date($github_dateformat, strtotime($commit->getCommit()->getAuthor()->getDate()));
					$p->save();
					$p->of(true);
				}
			}
		} else {
			 throw_error('Page supplied does not have a template of repository-commits');
		}
	}
