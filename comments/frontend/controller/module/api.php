<?php
namespace Commentics;

class ModuleApiController extends Controller
{
    public function index()
    {
        $this->loadModel('module/api');

        $this->response->addHeader('Content-Type: application/json');

        // Check if API module is installed and enabled
        if (!$this->setting->has('api_enabled')) {
            $this->send_response(503, [
                'status' => 'error',
                'message' => 'The API module is not installed'
            ]);
        } else if (!$this->setting->get('api_enabled')) {
            $this->send_response(503, [
                'status' => 'error',
                'message' => 'The API module is not enabled'
            ]);
        }

        // Get the IP address of the requester
        $ip_address = $this->user->getIpAddress();

        if ($this->model_module_api->hasMaxAttempts($ip_address)) {
            $this->send_response(403, [
                'status'  => 'error',
                'message' => "The IP address $ip_address is temporarily blocked due to too many failed attempts"
            ]);
        }

        // Get the IP address whitelist
        $ips = explode(',', $this->setting->get('api_ip_address'));

        if ($this->setting->get('api_check_ip') && !$this->user->doesCurrentIpAddressMatch($ips, $this->setting->get('api_check_ip'))) {
            $this->send_response(403, [
                'status'  => 'error',
                'message' => "The IP address $ip_address is not whitelisted"
            ]);
        }

        // Ensure POST method
        if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
            $this->send_response(405, [
                'status' => 'error',
                'message' => 'Only POST requests are allowed'
            ]);
        }

        // Ensure content type
        $content_type = isset($this->request->server['CONTENT_TYPE']) ? $this->request->server['CONTENT_TYPE'] : '';
        if (stripos($content_type, 'application/json') !== 0) {
            $this->send_response(400, [
                'status' => 'error',
                'message' => 'Content-Type must be application/json'
            ]);
        }

        // Decode JSON input
        $raw = file_get_contents('php://input');
        $input = json_decode($raw, true);

        if (!is_array($input)) {
            $this->send_response(400, [
                'status' => 'error',
                'message' => 'Invalid JSON'
            ]);
        }

        // Validate API key
        if (!isset($input['api_key'])) {
            $this->send_response(400, [
                'status' => 'error',
                'message' => 'Missing api_key parameter'
            ]);
        } else {
            if (!hash_equals($this->setting->get('api_key'), $input['api_key'])) {
                $this->model_module_api->addAttempt($ip_address);
                $this->send_response(401, [
                    'status' => 'error',
                    'message' => 'Invalid API key'
                ]);
            }
        }

        // Reset attempts on successful authentication
        $this->model_module_api->resetAttempts($ip_address);

        // Check action
        $action = isset($input['action']) ? $input['action'] : '';
        if (!$action) {
            $this->send_response(400, [
                'status' => 'error',
                'message' => 'Missing action parameter'
            ]);
        }

        // Handle actions
        switch ($action) {
            case 'update_user':
                $old_email = isset($input['old_email']) ? $input['old_email'] : '';
                $new_email = isset($input['new_email']) ? $input['new_email'] : '';
                $new_name  = isset($input['new_name']) ? $input['new_name'] : '';

                if (!$old_email || !$new_email || !$new_name) {
                    $this->send_response(400, [
                        'status' => 'error',
                        'message' => 'Missing parameters for update_user'
                    ]);
                }

                $user_id = $this->model_module_api->getUserIdByEmail($old_email);

                if ($user_id) {
                    $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "users` SET `email` = '" . $this->db->escape($new_email) . "', `name` = '" . $this->db->escape($new_name) . "' WHERE `email` = '" . $this->db->escape($old_email) . "'");

                    $this->send_response(200, [
                        'status' => 'success',
                        'updated' => 'true',
                        'message' => "User updated from $old_email to $new_email with name $new_name"
                    ]);
                } else {
                    $this->send_response(200, [
                        'status' => 'success',
                        'updated' => 'false',
                        'message' => "User not updated because no user found with the email address $old_email"
                    ]);
                }
            case 'delete_user':
                $email = isset($input['email']) ? $input['email'] : '';

                if (!$email) {
                    $this->send_response(400, [
                        'status' => 'error',
                        'message' => 'Missing email parameter for delete_user']);
                }

                $user_id = $this->model_module_api->getUserIdByEmail($email);

                if ($user_id) {
                    $this->user->deleteUser($user_id);

                    $this->send_response(200, [
                        'status' => 'success',
                        'deleted' => 'true',
                        'message' => "User with email $email deleted"
                    ]);
                } else {
                    $this->send_response(200, [
                        'status' => 'success',
                        'deleted' => 'false',
                        'message' => "User not deleted because no user found with the email address $email"
                    ]);
                }
            default:
                $this->send_response(400, ['error' => 'Unknown action']);
        }
    }

    private function send_response($status_code, $data) {
        http_response_code($status_code);
        echo json_encode($data);

        if ($this->setting->get('api_logging')) {
            $this->log->setFilename('api');
            $this->log->write($data);
        }

        exit;
    }
}
