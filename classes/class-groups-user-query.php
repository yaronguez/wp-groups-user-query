<?php
class Trestian_Groups_User_Query {
	/**
	 * Load the hooks
	 */
	public function run(){
		add_filter('pre_user_query', array($this, 'filter_groups'), 30, 1);
	}

	/**
	 * If the User Query includes a group_ids argument, filter the query accordingly
	 *
	 * @param $user_query WP_User_Query
	 *
	 * @return array
	 */
	public function filter_groups($user_query){
		// Determine if group_ids is in the query vars and Groups class exists
		if(!isset($user_query->query_vars['group_ids']) || !class_exists('Groups_Group', false) || !class_exists('Groups_Utility', false)){
			return $user_query;
		}

		/**
		 * The following is modified from the Groups plugin code, class-groups-admin-users.php, in the pre_user_query used in the admin panel
		 */
		global $wpdb;
		$group_ids = array_map( array( 'Groups_Utility', 'id' ), $user_query->query_vars['group_ids']  );
		$include = array();
		foreach ( $group_ids as $group_id ) {
			if ( Groups_Group::read( $group_id ) ) {
				$group = new Groups_Group( $group_id );
				$users = $group->users;
				if ( count( $users ) > 0 ) {
					foreach( $users as $user ) {
						$include[] = $user->user->ID;
					}
				} else { // no results
					$include[] = 0;
				}
				unset( $group );
				unset( $users );
			}
		}
		if ( count( $include ) > 0 ) {
			$include = array_unique( $include );
			$ids = implode( ',', wp_parse_id_list( $include ) );
			$user_query->query_where .= " AND $wpdb->users.ID IN ($ids)";
		}

		return $user_query;
	}
}