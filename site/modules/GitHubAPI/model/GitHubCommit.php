<?php

/**
 * GitHubCommit
 * Handles Data for GitHub Commit
 *
 * @author Pauldro
 * @see ../responses/commit.json
 *
 * @property string    $sha     Commit ID
 * @property string    $message Commit Message
 * @property string    $date    Commit Date
 * @property WireArray $files   Files that were affected
 */
class GitHubCommit extends WireData {

	public function __construct() {

	}

	/**
	 * Parses data and populates the properties
	 * @param  array $data Commit Array
	 * @return void
	 */
	public function hydrate($data) {
		$this->sha = $data['sha'];
		$this->message = $data['commit']['message'];
		$this->date = $data['commit']['author']['date'];
		$this->hydrate_files($data);
	}

	/**
	 * Parses and fills in data for the self::$files property
	 * @param  array $data Commit Array
	 * @return void
	 */
	private function hydrate_files($data) {
		$this->files = new WireArray();

		foreach ($data['files'] as $changedfile) {
			$file = new WireData();
			$file->name = $changedfile['filename'];
			$file->status = $changedfile['status'];

			$this->files->add($file);
		}
	}

	/**
	 * Instantiates object of this class and Populates data
	 * @param  array $data Commit Array
	 * @return GitHubCommit
	 */
	public static function build($data) {
		$commit = new GitHubCommit();
		$commit->hydrate($data);
		return $commit;
	}

	public function getArray() {
		$array = parent::getArray();

		$array['files'] = array();
		foreach ($this->files as $file) {
			$array['files'][] = $file->getArray();
		}
		return $array;
	}
}
