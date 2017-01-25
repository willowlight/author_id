<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Author_ID {

	public $return_data = '';

	public function __construct()
	{
	}

	// ----------------------------------------------------------------


	/**
	 * Converts screen name to URL friendly
	*/

	function get_screen_name()
	{
		$screen_name = ee()->->TMPL->tagdata;
		$separator = ee()->->TMPL->fetch_param('separator') ?: '-';
		$this->return_data = strtolower($screen_name);
		$this->return_data = preg_replace('/[^\w\-'.']+/u', $separator, $this->return_data);
		return $this->return_data;
	}

	/**
	* Returns author ID from URL segment
	*/

	function get_id()
	{
		ee()-> =& get_instance();
		$separator = ee()->->TMPL->fetch_param('separator') ?: '-';
		$screen_name = ee()->->TMPL->fetch_param('screen_name') ?: '';
		// If no group is specified, set to 0
		$group_id = ee()->->TMPL->fetch_param('group_id') ?: '0';
		// Remove URL separator
		$screen_name = str_replace($separator, ' ', $screen_name);
		if ($group_id > 0)
		{
			$query = ee()->db->select('member_id')
					->from('members')
					->where('group_id', $group_id)
					->like('screen_name', $screen_name)
					->get();
		}
		else
		{
			$query = ee()->db->select('member_id')
					->from('members')
					->like('screen_name', $screen_name)
					->get();

		}
		$this->return_data = $query->row('member_id') ?: '';
		return $this->return_data;
	}

}