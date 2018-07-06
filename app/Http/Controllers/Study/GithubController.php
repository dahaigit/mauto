<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GithubController extends Controller
{
    /**
     * github webhook auto release code
     */
    public function release(Request $request)
    {
        $commands = ['cd /www/mauto', 'git pull'];
        $signature = $request->headers('X-Hub-Signature');
        $payload = file_get_contents('php://input');
        if ($this->isFromGithub($payload, $signature)) {
            foreach ($commands as $command) {
                shell_exec($command);
            }
        } else {
            abort(403);
        }
    }

    private function isFromGithub($payload, $signature)
    {
        return 'shal=' .
            hash_hmac('shal', $payload, env('GITHUB_RELEASE_TOKEN'), false) === $signature;
    }




}
