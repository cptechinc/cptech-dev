<?php
	use Dplus\Base\QueryBuilder;
	use Dplus\ProcessWire\DplusWire;

	/* =============================================================
		LOGIN FUNCTIONS
	============================================================= */
	/**
	 * Returns Error Message for Session
	 * @param  string $sessionID Session Identifier
	 * @param  bool   $debug     Run in debug? If so, return SQL Query
	 * @return string            Error Message for Login / Session
	 */
	function get_loginerrormsg($sessionID, $debug = false) {
		$q = (new QueryBuilder())->table('logperm');
		$q->field('errormsg');
		$q->where('sessionid', $sessionID);
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return $sql->fetchColumn();
		}
	}
