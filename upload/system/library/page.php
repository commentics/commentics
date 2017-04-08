<?php
namespace Commentics;

class Page {
	private $id = 0;
	private $identifier = '';
	private $reference = '';
	private $page_url = '';
	private $form_enabled = true;
	private $db;
	private $request;
	private $security;
	private $url;

	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->security = $registry->get('security');
		$this->url = $registry->get('url');

		if (defined('CMTX_IDENTIFIER')) {
			$this->identifier = $this->security->encode(CMTX_IDENTIFIER);
		}

		if (defined('CMTX_REFERENCE')) {
			$this->reference = $this->security->encode(CMTX_REFERENCE);
		}

		if ($this->identifier) {
			$page = $this->getPageByIdentifier($this->identifier);

			if ($page) {
				$this->id = $page['id'];

				$this->page_url = $page['url'];

				$this->form_enabled = $page['is_form_enabled'];
			} else {
				$this->id = $this->createPage();
			}
		} else if ($this->request->isAjax() && isset($this->request->post['cmtx_page_id']) && $this->pageExists($this->request->post['cmtx_page_id'])) {
			$this->id = $this->request->post['cmtx_page_id'];

			$page = $this->getPage($this->id);

			$this->reference = $page['reference'];

			$this->page_url = $page['url'];
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getIdentifier() {
		return $this->identifier;
	}

	public function getReference() {
		return $this->reference;
	}

	public function getUrl() {
		return $this->page_url;
	}

	public function isFormEnabled() {
		return $this->form_enabled;
	}

	public function pageExists($id) {
		if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "pages` WHERE `id` = '" . (int)$id . "'"))) {
			return true;
		} else {
			return false;
		}
	}

	public function getPageByIdentifier($identifier) {
		$query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "pages` WHERE `identifier` = '" . $this->db->escape($identifier) . "'");

		$result = $this->db->row($query);

		return $result;
	}

	public function createPage() {
		$this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "pages` SET `identifier` = '" . $this->db->escape($this->identifier) . "', `reference` = '" . $this->db->escape($this->reference) . "', `url` = '" . $this->db->escape($this->url->getPageUrl()) . "', `moderate` = 'default', `is_form_enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");

		return $this->db->insertId();
	}

	public function getPage($id) {
		$query = $this->db->query(" SELECT `p`.*,
									(SELECT COUNT(`id`) FROM `" . CMTX_DB_PREFIX . "subscriptions` `s` WHERE `s`.`page_id` = `p`.`id`) AS `subscriptions`,
									(SELECT COUNT(`id`) FROM `" . CMTX_DB_PREFIX . "comments` `c` WHERE `c`.`page_id` = `p`.`id`) AS `comments`
									FROM `" . CMTX_DB_PREFIX . "pages` `p`
									WHERE `p`.`id` = '" . (int)$id . "'");

		if ($this->db->numRows($query)) {
			$page = $this->db->row($query);

			return array(
				'id'				=> $page['id'],
				'identifier' 		=> $page['identifier'],
				'reference' 		=> $page['reference'],
				'url' 				=> $page['url'],
				'comments' 			=> $page['comments'],
				'subscriptions' 	=> $page['subscriptions'],
				'moderate' 			=> $page['moderate'],
				'is_form_enabled' 	=> $page['is_form_enabled'],
				'date_modified' 	=> $page['date_modified'],
				'date_added' 		=> $page['date_added']
			);
		} else {
			return false;
		}
	}

	public function getPages() {
		$query = $this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "pages`");

		$results = $this->db->rows($query);

		$pages = array();

		foreach ($results as $result) {
			$pages[$result['id']] = $this->getPage($result['id']);
		}

		return $pages;
	}

	public function deletePage($id) {
		$this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "comments` WHERE `page_id` = '" . (int)$id . "'");

		$this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `page_id` = '" . (int)$id . "'");

		$this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "pages` WHERE `id` = '" . (int)$id . "'");

		if ($this->db->affectedRows()) {
			return true;
		} else {
			return false;
		}
	}
}
?>