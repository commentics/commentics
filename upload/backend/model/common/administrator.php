<?php
namespace Commentics;

class CommonAdministratorModel extends Model
{
    public function adminExists($id)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "admins` WHERE `id` = '" . (int) $id . "'"))) {
            return true;
        } else {
            return false;
        }
    }

    public function getAdmin($id)
    {
        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "admins` WHERE `id` = '" . (int) $id . "'");

        $result = $this->db->row($query);

        return $result;
    }

    public function getAdmins()
    {
        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "admins`");

        $results = $this->db->rows($query);

        return $results;
    }

    public function usernameExists($username, $id = 0)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "admins` WHERE `username` = '" . $this->db->escape($username) . "' AND `id` != '" . (int) $id . "'"))) {
            return true;
        } else {
            return false;
        }
    }

    public function getAdminByUsername($username)
    {
        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "admins` WHERE `username` = '" . $this->db->escape($username) . "'");

        $result = $this->db->row($query);

        return $result;
    }

    public function emailExists($email, $id = 0)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "admins` WHERE `email` = '" . $this->db->escape($email) . "' AND `id` != '" . (int) $id . "'"))) {
            return true;
        } else {
            return false;
        }
    }

    public function getAdminByEmail($email)
    {
        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "admins` WHERE `email` = '" . $this->db->escape($email) . "'");

        $result = $this->db->row($query);

        return $result;
    }

    public function getRestrictions($id = '')
    {
        if ($id) {
            $admin = $this->getAdmin($id);
        } else {
            $admin = '';
        }

        if (isset($this->request->post['viewable_pages'])) {
            $viewable_pages = implode(',', $this->request->post['viewable_pages']);
        } else if ($admin) {
            $viewable_pages = $admin['viewable_pages'];
        } else {
            $viewable_pages = '';
        }

        if (isset($this->request->post['modifiable_pages'])) {
            $modifiable_pages = implode(',', $this->request->post['modifiable_pages']);
        } else if ($admin) {
            $modifiable_pages = $admin['modifiable_pages'];
        } else {
            $modifiable_pages = '';
        }

        $viewable_pages = explode(',', $viewable_pages);

        $modifiable_pages = explode(',', $modifiable_pages);

        $restrictions = array();

        $restrictions[] = $this->getRestriction('Manage', 'manage', 0, true, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Admins', 'manage/admins', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Add', 'add/admin', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Edit', 'edit/admin', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Bans', 'manage/bans', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Add', 'add/ban', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Edit', 'edit/ban', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Comments', 'manage/comments', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Edit', 'edit/comment', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Spam', 'edit/spam', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Countries', 'manage/countries', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Add', 'add/country', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Edit', 'edit/country', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Pages', 'manage/pages', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Edit', 'edit/page', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Questions', 'manage/questions', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Add', 'add/question', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Edit', 'edit/question', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Sites', 'manage/sites', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Add', 'add/site', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Edit', 'edit/site', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('States', 'manage/states', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Add', 'add/state', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Edit', 'edit/state', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Subscriptions', 'manage/subscriptions', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Edit', 'edit/subscription', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Users', 'manage/users', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Edit', 'edit/user', 40, false, $viewable_pages, $modifiable_pages);

        $restrictions[] = $this->getRestriction('Extensions', 'extensions', 0, true, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Installer', 'extension/installer', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Languages', 'extension/languages', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Modules', 'extension/modules', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Edit', 'module/', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Themes', 'extension/themes', 20, false, $viewable_pages, $modifiable_pages);

        $restrictions[] = $this->getRestriction('Settings', 'settings', 0, true, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Administrator', 'settings/administrator', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Approval', 'settings/approval', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Cache', 'settings/cache', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Email', 'settings/email', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Editor', 'settings/email_editor', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Setup', 'settings/email_setup', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Error Reporting', 'settings/error_reporting', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Flooding', 'settings/flooding', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Layout', 'settings/layout', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Comments', 'settings/layout_comments', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Gravatar', 'layout_comments/gravatar', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Name', 'layout_comments/name', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Town', 'layout_comments/town', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Country', 'layout_comments/country', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Rating', 'layout_comments/rating', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Comment', 'layout_comments/comment', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Date', 'layout_comments/date', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Like', 'layout_comments/like', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Dislike', 'layout_comments/dislike', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Share', 'layout_comments/share', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Flag', 'layout_comments/flag', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Permalink', 'layout_comments/permalink', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Reply', 'layout_comments/reply', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Average Rating', 'layout_comments/average_rating', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Notify', 'layout_comments/notify', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Online', 'layout_comments/online', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Page Number', 'layout_comments/page_number', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Pagination', 'layout_comments/pagination', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('RSS', 'layout_comments/rss', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Search', 'layout_comments/search', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Social', 'layout_comments/social', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Sort By', 'layout_comments/sort_by', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Topic', 'layout_comments/topic', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('General', 'layout_comments/general', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Form', 'settings/layout_form', 40, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Name', 'layout_form/name', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Email', 'layout_form/email', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Website', 'layout_form/website', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Town', 'layout_form/town', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Country', 'layout_form/country', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Rating', 'layout_form/rating', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('BB Code', 'layout_form/bb_code', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Smilies', 'layout_form/smilies', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Comment', 'layout_form/comment', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Question', 'layout_form/question', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Captcha', 'layout_form/captcha', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Notify', 'layout_form/notify', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Cookie', 'layout_form/cookie', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Privacy', 'layout_form/privacy', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Terms', 'layout_form/terms', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Preview', 'layout_form/preview', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Powered', 'layout_form/powered', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('General', 'layout_form/general', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Licence', 'settings/licence', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Maintenance', 'settings/maintenance', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Processor', 'settings/processor', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('List', 'data/list', 60, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Security', 'settings/security', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('System', 'settings/system', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Viewers', 'settings/viewers', 20, false, $viewable_pages, $modifiable_pages);

        $restrictions[] = $this->getRestriction('Tasks', 'tasks', 0, true, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Delete Bans', 'task/delete_bans', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Delete Comments', 'task/delete_comments', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Delete Reporters', 'task/delete_reporters', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Delete Subscriptions', 'task/delete_subscriptions', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Delete Voters', 'task/delete_voters', 20, false, $viewable_pages, $modifiable_pages);

        $restrictions[] = $this->getRestriction('Reports', 'reports', 0, true, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Access', 'report/access', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Errors', 'report/errors', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Permissions', 'report/permissions', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('PHP Info', 'report/phpinfo', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Version', 'report/version', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Version Check', 'report/version_check', 20, false, $viewable_pages, $modifiable_pages);        
        $restrictions[] = $this->getRestriction('Viewers', 'report/viewers', 20, false, $viewable_pages, $modifiable_pages);

        $restrictions[] = $this->getRestriction('Tools', 'tools', 0, true, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Database Backup', 'tool/database_backup', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Export / Import', 'tool/export_import', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Optimize Tables', 'tool/optimize_tables', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Text Finder', 'tool/text_finder', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Upgrade', 'tool/upgrade', 20, false, $viewable_pages, $modifiable_pages);

        $restrictions[] = $this->getRestriction('Help', 'help', 0, true, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Donate', 'help/donate', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('FAQ', 'help/faq', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('Forum', 'help/forum', 20, false, $viewable_pages, $modifiable_pages);
        $restrictions[] = $this->getRestriction('License', 'help/license', 20, false, $viewable_pages, $modifiable_pages);

        return $restrictions;
    }

    private function getRestriction($title, $page, $indent, $is_top, $viewable_pages, $modifiable_pages)
    {
        if (in_array($page, $viewable_pages)) {
            $is_viewable = true;
        } else {
            $is_viewable = false;
        }

        if (in_array($page, $modifiable_pages)) {
            $is_modifiable = true;
        } else {
            $is_modifiable = false;
        }

        $restriction = array(
            'title'         => $title,
            'page'          => $page,
            'indent'        => $indent . 'px',
            'is_top'        => $is_top,
            'is_viewable'   => $is_viewable,
            'is_modifiable' => $is_modifiable
        );

        return $restriction;
    }
}
