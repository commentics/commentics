<?php
namespace Commentics;

class MainDashboardController extends Controller {
	public function index() {
		if (!$this->setting->get('checklist_complete')) {
			$this->response->redirect('main/checklist');
		}

		$this->loadLanguage('main/dashboard');

		$this->loadModel('main/dashboard');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ($this->validate()) {
				$this->model_main_dashboard->update($this->request->post, $this->session->data['cmtx_username']);
			}
		}

		if (!isset($this->session->data['cmtx_hide_dashboard_notice'])) {
			if ($this->model_main_dashboard->getNumCommentsApprove()) {
				$this->data['warning'] = sprintf($this->data['lang_message_comments'], $this->url->link('manage/comments', '&filter_approved=0'));
			} else if ($this->model_main_dashboard->hasErrors()) {
				$this->data['warning'] = sprintf($this->data['lang_message_errors'], $this->url->link('report/errors'));
			}
		}

		if (extension_loaded('curl') || (bool)ini_get('allow_url_fopen')) {
			$latest_version = $this->model_main_dashboard->getLatestVersion();

			if ($this->validation->isFloat($latest_version)) {
				if (version_compare($this->model_main_dashboard->getCurrentVersion(), $latest_version, '<')) {
					$this->data['version_check'] = array('type' => 'negative', 'text' => $this->data['lang_text_version_newer']);
				} else {
					$this->data['version_check'] = array('type' => 'positive', 'text' => $this->data['lang_text_version_latest']);
				}
			} else {
				$site_issue = true;

				$this->data['version_check'] = array('type' => 'negative', 'text' => $this->data['lang_text_version_issue']);
			}
		} else {
			$this->data['version_check'] = array('type' => 'negative', 'text' => $this->data['lang_text_version_unable']);
		}

		$this->data['lang_text_last_login'] = sprintf($this->data['lang_text_last_login'], $this->variable->formatDate($this->model_main_dashboard->getLastLogin(), $this->data['lang_time_format'], $this->data), $this->variable->formatDate($this->model_main_dashboard->getLastLogin(), $this->data['lang_date_format'], $this->data));

		$this->data['lang_text_stats_action'] = sprintf($this->data['lang_text_stats_action'], $this->model_main_dashboard->getNumCommentsApprove(), $this->model_main_dashboard->getNumCommentsFlagged());

		$this->data['lang_text_stats_today'] = sprintf($this->data['lang_text_stats_today'], $this->model_main_dashboard->getNumCommentsNew(), $this->model_main_dashboard->getNumSubscriptionsNew(), $this->model_main_dashboard->getNumBansNew());

		$this->data['lang_text_stats_total'] = sprintf($this->data['lang_text_stats_total'], $this->model_main_dashboard->getNumCommentsTotal(), $this->model_main_dashboard->getNumSubscriptionsTotal(), $this->model_main_dashboard->getNumBansTotal());

		$this->data['tip_of_the_day'] = $this->model_main_dashboard->getTipOfTheDay();

		if (extension_loaded('curl') || (bool)ini_get('allow_url_fopen')) {
			if (isset($site_issue)) {
				$this->data['news'] = $this->data['lang_text_no_news'];
			} else {
				$news = $this->model_main_dashboard->getNews();

				$news = $this->security->encode($news);

				$news = nl2br($news, false);

				$this->data['news'] = $news;
			}
		} else {
			$this->data['news'] = $this->data['lang_text_no_news'];
		}

		$this->data['quick_links'] = $this->model_main_dashboard->getQuickLinks();

		if ($this->setting->has('chart_enabled') && $this->setting->get('chart_enabled')) {
			$this->data['chart_enabled'] = true;

			$this->data['chart_comments'] = $this->model_main_dashboard->getChartComments();

			$this->data['chart_subscriptions'] = $this->model_main_dashboard->getChartSubscriptions();
		} else {
			$this->data['chart_enabled'] = false;
		}

		if ((extension_loaded('curl') || (bool)ini_get('allow_url_fopen')) && !isset($site_issue)) {
			$this->model_main_dashboard->callHome();

			$sponsors = $this->model_main_dashboard->getSponsors();

			$sponsors = json_decode($sponsors, true);

			$this->data['sponsors'] = $sponsors['sponsors'];
		} else {
			$this->data['sponsors'] = array();
		}

		if (isset($this->request->post['notes'])) {
			$this->data['notes'] = $this->request->post['notes'];
		} else {
			$this->data['notes'] = $this->model_main_dashboard->getNotes();
		}

		if (isset($this->error['notes'])) {
			$this->data['error_notes'] = $this->error['notes'];
		} else {
			$this->data['error_notes'] = '';
		}

		$this->components = array('common/header', 'common/footer');

		$this->loadView('main/dashboard');
	}

	public function dismiss() {
		$this->session->data['cmtx_hide_dashboard_notice'] = true;
	}

	private function validate() {
		$this->loadModel('common/poster');

		$unpostable = $this->model_common_poster->unpostable($this->data);

		if ($unpostable) {
			$this->data['error'] = $unpostable;

			return false;
		}

		if (!isset($this->request->post['notes']) || $this->validation->length($this->request->post['notes']) < 0 || $this->validation->length($this->request->post['notes']) > 5000) {
			$this->error['notes'] = sprintf($this->data['lang_error_length'], 0, 5000);
		}

		if ($this->error) {
			$this->data['error'] = $this->data['lang_message_error'];

			return false;
		} else {
			$this->data['success'] = $this->data['lang_message_success'];

			return true;
		}
	}
}
?>