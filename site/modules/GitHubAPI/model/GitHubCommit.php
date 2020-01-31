<?php
class GitHubCommit extends WireData {

	public function __construct() {

	}

	public function hydrate($data) {
		$this->sha = $data['sha'];
		$this->message = $data['commit']['message'];
		$this->date = $data['commit']['author']['date'];
		$this->hydrate_files($data);
	}

	private function hydrate_files($data) {
		$this->files = new WireArray();

		foreach ($data['files'] as $changedfile) {
			$file = new WireData();
			$file->name = $changedfile['filename'];
			$file->status = $changedfile['status'];

			$this->files->add($file);
		}
	}

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
