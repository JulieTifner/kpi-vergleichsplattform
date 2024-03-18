<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class InvitationController extends Controller
{
    /**
     * Displays the invitations view for moderators and invite token from session.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $inviteToken = Session::get('inviteToken', null);

        return view('moderator.invitations', [
            'inviteToken' => $inviteToken,
        ]);
    }

    /**
     * Generates a new invitation token, saves it in session and stores it in database with an expiration date.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $inviteToken = $this->randHash(20);
        
        Session::put('inviteToken', $inviteToken);

        Invitation::create([
            'token'           => $inviteToken,
            'expiration_date' => Carbon::now()->addDays(7)
        ]);

        return redirect()->back();
    }

    /**
     * Generates a random hash string of a specified length.
     *
     * @param int $len
     * @return string 
     * 
     */
    function randHash($len = 32)
    {
        return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
    }


}
