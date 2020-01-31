<?php
use Github\Client as GithubClient;

class GitHubAPIRepositories extends WireData {

	public function __construct() {
		$this->client = new GithubClient();
	}


	public function list_repos_user($user) {
		return $this->client->api('user')->repositories($user);
	}

	public function list_branches_repo($owner, $repo) {
		return $this->client->api('repo')->branches($owner, $repo);
	}

	public function get_repo($owner, $repo) {
		return $this->client->api('repo')->show($owner, $repo);
	}

}
