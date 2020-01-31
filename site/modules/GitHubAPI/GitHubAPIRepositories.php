<?php
use Github\Client as GithubClient;

class GitHubAPIRepositories extends WireData {

	public function __construct() {
		$this->client = new GithubClient();
	}


	/**
	 * Returns a List of User's Repos
	 * @param  string $user User Name
	 * @return array
	 */
	public function list_repos_user($user) {
		return $this->client->api('user')->repositories($user);
	}

	/**
	 * Returns a List of Repo Branches
	 * @param  string $owner Repository Owner
	 * @param  string $repo  Repository Name
	 * @return array
	 */
	public function list_branches_repo($owner, $repo) {
		return $this->client->api('repo')->branches($owner, $repo);
	}

	/**
	 * Returns Repository
	 * @param  string $owner Repository Owner
	 * @param  string $repo  Repository Name
	 * @return array
	 */
	public function get_repo($owner, $repo) {
		return $this->client->api('repo')->show($owner, $repo);
	}

}
