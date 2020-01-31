<?php
use Github\Client as GithubClient;

class GitHubAPICommits extends WireData {

	public function __construct() {
		$this->client = new GithubClient();
	}

	/**
	 * Return GitHubCommits
	 * @param  string $owner  Repository Owner
	 * @param  string $repo   Repository Name
	 * @param  string $branch Repository Branch
	 * @return GitHubCommit[]
	 */
	public function list_commits($owner, $repo, $branch = 'master') {
		$commits = array();
		$response = $this->client->api('repo')->commits()->all($owner, $repo, array('sha' => $branch));

		foreach ($response as $commit_github) {
			$commit = GitHubCommit::build($commit_github);
			$commits[] = $commit;
		}
		return $commits;
	}

	/**
	 * Return Commit
	 * @param  string $owner  Repository Owner
	 * @param  string $repo   Repository Name
	 * @param  string $sha    Commit ID
	 * @return GitHubCommit
	 */
	public function get_commit($owner, $repo, $sha) {
		$response = $this->client->api('repo')->commits()->show($owner, $repo, $sha);
		return GitHubCommit::build($response);
	}
}
