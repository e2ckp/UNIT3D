<?php
/**
 * NOTICE OF LICENSE.
 *
 * UNIT3D is open-sourced software licensed under the GNU General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D
 *
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 * @author     HDVinnie
 */

namespace App\Listeners;

use Carbon\Carbon;

class LoginListener
{
    /**
     * Handle the event.
     *
     * @param  auth.login  $event
     * @return void
     */
    public function handle($event)
    {
        // Online Block
        $current = Carbon::now();
        $expiresAt = $current->addHours(2);
        if ($event->user !== null) {
            $event->user->setCache($expiresAt);
        }

        // Update Login Timestamp
        $event->user->last_login = Carbon::now();
        $event->user->save();
    }
}
