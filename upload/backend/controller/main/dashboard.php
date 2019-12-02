<?php
namespace Commentics;

class MainDashboardController extends Controller
{
    public function index()
    {
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

        $site_issue = false;

        if (extension_loaded('curl') || (bool) ini_get('allow_url_fopen')) {
            $latest_version = $this->home->getLatestVersion();

            if ($this->validation->isFloat($latest_version)) {
                if (version_compare($this->model_main_dashboard->getCurrentVersion(), $latest_version, '<')) {
                    $this->data['version_check'] = array(
                                                        'type'      => 'negative',
                                                        'text'      => $this->data['lang_text_version_newer'],
                                                        'link'      => true,
                                                        'link_href' => $this->url->link('tool/upgrade'),
                                                        'link_text' => $this->data['lang_link_upgrade']
                                                        );
                } else {
                    $this->data['version_check'] = array(
                                                        'type' => 'positive',
                                                        'text' => $this->data['lang_text_version_latest'],
                                                        'link' => false
                                                        );
                }
            } else {
                $site_issue = true;

                $this->data['version_check'] = array(
                                                    'type'      => 'negative',
                                                    'text'      => $this->data['lang_text_site_issue'],
                                                    'link'      => true,
                                                    'link_href' => $this->url->link('report/version_check'),
                                                    'link_text' => $this->data['lang_link_log']
                                                    );
            }
        } else {
            $this->data['version_check'] = array(
                                                'type' => 'negative',
                                                'text' => $this->data['lang_text_unable'],
                                                'link' => false
                                                );
        }

        $this->data['lang_text_last_login'] = sprintf($this->data['lang_text_last_login'], $this->variable->formatDate($this->model_main_dashboard->getLastLogin(), $this->data['lang_time_format'], $this->data), $this->variable->formatDate($this->model_main_dashboard->getLastLogin(), $this->data['lang_date_format'], $this->data));

        $this->data['lang_text_stats_action'] = sprintf($this->data['lang_text_stats_action'], $this->model_main_dashboard->getNumCommentsApprove(), $this->model_main_dashboard->getNumCommentsFlagged());

        $this->data['lang_text_stats_today'] = sprintf($this->data['lang_text_stats_today'], $this->model_main_dashboard->getNumCommentsNew(), $this->model_main_dashboard->getNumSubscriptionsNew(), $this->model_main_dashboard->getNumBansNew());

        $this->data['lang_text_stats_total'] = sprintf($this->data['lang_text_stats_total'], $this->model_main_dashboard->getNumCommentsTotal(), $this->model_main_dashboard->getNumSubscriptionsTotal(), $this->model_main_dashboard->getNumBansTotal());

        $this->data['tip_of_the_day'] = $this->model_main_dashboard->getTipOfTheDay();

        if (extension_loaded('curl') || (bool) ini_get('allow_url_fopen')) {
            if ($site_issue) {
                $this->data['news'] = $this->data['lang_text_no_news'];
            } else {
                $news = $this->home->getNews();

                $news = $this->security->encode($news);

                $news = nl2br($news, false);

                $this->data['news'] = $news;
            }
        } else {
            $this->data['news'] = $this->data['lang_text_no_news'];
        }

        $this->data['quick_links'] = $this->model_main_dashboard->getQuickLinks();

        $this->data['licence'] = $this->setting->get('licence');

        $this->data['is_licence_valid'] = false;

        $this->data['licence_result'] = '';

        if ($this->setting->get('licence')) {
            if ((extension_loaded('curl') || (bool) ini_get('allow_url_fopen'))) {
                if ($site_issue && $this->setting->get('licence')) {
                    $this->data['is_licence_valid'] = true;
                } else {
                    $check = $this->home->checkLicence($this->setting->get('licence'), $this->setting->get('forum_user'));

                    $check = json_decode($check, true);

                    if (isset($check['result']) && $check['result'] == 'valid') {
                        $this->data['is_licence_valid'] = true;
                    }

                    $this->data['licence_result'] = 'invalid';
                }
            } else {
                $this->data['licence_result'] = 'unable';
            }
        } else {
            $this->data['licence_result'] = 'none';

            if ($this->model_main_dashboard->getDaysInstalled() >= 10) {
                $this->data['info'] = sprintf($this->data['lang_notice'], 'https://www.commentics.org/pricing');
            }
        }

        if (!$this->data['is_licence_valid']) {
            $this->model_main_dashboard->enabledPoweredBy();
        }

        if ($this->setting->has('chart_enabled') && $this->setting->get('chart_enabled')) {
            $this->data['chart_enabled'] = true;

            $this->data['chart_comments'] = $this->model_main_dashboard->getChartComments();

            $this->data['chart_subscriptions'] = $this->model_main_dashboard->getChartSubscriptions();
        } else {
            $this->data['chart_enabled'] = false;
        }

        if ((extension_loaded('curl') || (bool) ini_get('allow_url_fopen')) && !$site_issue) {
            $this->home->callHome();

            $sponsors = $this->home->getSponsors();

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

        if ($this->setting->get('check_referrer')) {
            $url = $this->url->decode($this->url->getPageUrl());

            $domain = $this->url->decode($this->setting->get('site_domain'));

            if (!$this->variable->stristr($url, $domain)) { // if URL does not contain domain
                $this->model_main_dashboard->disableCheckReferrer();
            }
        }

        $this->components = array('common/header', 'common/footer');

        $this->loadView('main/dashboard');
    }

    public function dismiss()
    {
        $this->session->data['cmtx_hide_dashboard_notice'] = true;
    }

    private function validate()
    {
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
